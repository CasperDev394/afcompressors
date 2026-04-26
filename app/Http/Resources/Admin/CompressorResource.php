<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CompressorResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'name_slug' => $this->resource->name_slug,
            'pressure_category' => $this->resource->pressure_category,
            'msf' => $this->resource->msf,
            'capacities_iso' => $this->resource->capacities_iso,
            'models' => $this->whenLoaded('models', function () use ($request) {
                return CompressorModelResource::collection($this->resource->models)->resolve($request);
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
