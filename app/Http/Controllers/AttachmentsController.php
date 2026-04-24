<?php

namespace App\Http\Controllers;

use App\Services\AttachmentService\AttachmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class AttachmentsController extends Controller
{
    public function uploadFile(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'max:10240'],
            'attachmentableType' => ['required', 'string'],
        ]);

        $attachmentableType = strtoupper((string) $request->input('attachmentableType'));

        $dir = match ($attachmentableType) {
            'COMPRESSOR' => 'compressors/' . date('Y/m'),
            default => 'uploads/' . date('Y/m'),
        };

        /** @var UploadedFile $file */
        $file = $request->file('file');
        $path = $file->store($dir, 'storagePublic');

        $attachment = (new AttachmentService())->createAttach($path);

        return response()->json([
            'status' => 'OK',
            'data' => [
                'id' => $attachment->id,
                'title' => $attachment->title,
                'extension' => $attachment->extension,
                'mimeType' => $attachment->mime,
                'size' => $attachment->size,
                'url' => $attachment->url,
                'previews' => [
                    [
                        'description' => '116x116',
                        'id' => $attachment->id,
                        'url' => $attachment->url,
                    ],
                ],
            ],
        ]);
    }
}
