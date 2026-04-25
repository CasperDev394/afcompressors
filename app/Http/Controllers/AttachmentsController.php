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
        $attachmentableType = strtoupper((string) $request->input('attachmentableType'));
        $rules = [
            'attachmentableType' => ['required', 'string'],
        ];

        if ($attachmentableType === 'OPTION_ICON') {
            $rules['file'] = [
                'required',
                'file',
                'max:10240',
                function ($attribute, $value, $fail) {
                    /** @var UploadedFile $value */
                    if (strtolower((string) $value->getClientOriginalExtension()) !== 'svg') {
                        $fail('The '.$attribute.' field must be an SVG file.');
                    }
                },
            ];
        } else {
            $rules['file'] = ['required', 'image', 'max:10240'];
        }

        $request->validate($rules);

        $dir = match ($attachmentableType) {
            'COMPRESSOR' => 'compressors/' . date('Y/m'),
            'OPTION_ICON' => 'options/icons/' . date('Y/m'),
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
