<?php

namespace App\Services\AttachmentService;


use Exception;
use App\Models\Attachment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentService
{
    public function createAttach(string $path, string $disk = 'storagePublic'): Attachment
    {
        $fullpath = Storage::disk($disk)->path($path);
        $attachment = new Attachment();
        $attachment->disk = $disk;
        $attachment->name = File::name($fullpath);
        $attachment->path = Str::finish(dirname($path), '/');
        $attachment->extension = File::extension($fullpath);
        $attachment->mime = File::mimeType($fullpath);
        $attachment->hash = File::hash($fullpath, 'sha1');
        $attachment->size = File::size($fullpath);
        $attachment->save();
        return $attachment;
    }

    public static function getAttachesByNames(array $imgNames): Collection
    {
        $photoNames = collect($imgNames)->map(function ($photo) {
            $dotPos = mb_strlen($photo) - mb_strpos($photo, '.');
            return substr($photo, 3,-$dotPos);
        })->filter()->values();

        $attaches = Attachment::query()->whereIn('name', $photoNames)->get()->keyBy('name');

        return $photoNames->map(fn($photoName) => $attaches->get($photoName))->filter()->values();
    }

    public static function deleteAttachAndFile(Attachment $attachment): void
    {
        try {
            //удаляем preview наглухо
            $attachment->previews->each(function( Attachment $attachmentPreview) {
                $previewWasDeleted = self::deleteFile($attachmentPreview->disk, $attachmentPreview->physicalPath());

                throw_if($previewWasDeleted === false, new Exception('Не получилось удалить файл preview id:'.$attachmentPreview->id));

                $attachmentPreview->forceDelete();
            });

            $fileWasDeleted = self::deleteFile($attachment->disk, $attachment->physicalPath());

            throw_if($fileWasDeleted === false, new Exception('Не получилось удалить файл id:'.$attachment->id));

            $attachment->deleted_at = now();
            $attachment->saveQuietly();

        } catch(Exception $e) {
            Log::channel('file_errors')->info($e->getMessage());
        }
    }

    private static function deleteFile(string $disk, string $fullPath): bool
    {
        if ( !in_array($disk, ['storageSecure', 'storagePublic']) && !app()->environment('production')) {
            return true;
        }
        return Storage::disk($disk)->delete($fullPath);
    }
}
