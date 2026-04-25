<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionPostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'name_slug' => $this->resource->name_slug,
            'description' => $this->resource->description,
            'option_id' => $this->resource->option_id,
            'published' => (bool) $this->resource->published,
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
