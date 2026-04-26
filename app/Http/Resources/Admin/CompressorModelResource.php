<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CompressorModelResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'compressor_id' => $this->resource->compressor_id,
            'capacity' => $this->resource->capacity !== null ? (float) $this->resource->capacity : null,
            'FAD' => $this->resource->FAD,
            'CFM' => $this->resource->CFM,
            'installed_power' => $this->resource->installed_power,
        ];
    }
}
