<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'name_slug' => $this->resource->name_slug,
            'published' => (bool) $this->resource->published,
            'eco' => (bool) $this->resource->eco,
            'icon_attachment' => $this->whenLoaded('iconAttachment', function () {
                if (!$this->resource->iconAttachment) {
                    return null;
                }

                return [
                    'id' => $this->resource->iconAttachment->id,
                    'url' => $this->resource->iconAttachment->url,
                    'title' => $this->resource->iconAttachment->title,
                    'extension' => $this->resource->iconAttachment->extension,
                ];
            }),
            'posts' => $this->whenLoaded('posts', function () use ($request) {
                return OptionPostResource::collection($this->resource->posts)->resolve($request);
            }),
            'attachments' => $this->whenLoaded('attachments', function () {
                return $this->resource->attachments->map(function ($attachment) {
                    return [
                        'id' => $attachment->id,
                        'url' => $attachment->url,
                        'title' => $attachment->title,
                    ];
                })->values();
            }),
        ];
    }
}
