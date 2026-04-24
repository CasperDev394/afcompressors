<?php

namespace App\Services;

use App\Helpers\Str;
use App\Models\Compressor;

class CompressorService
{
    protected ?Compressor $compressor;

    public function __construct(?Compressor $compressor = null)
    {
        $this->compressor = $compressor;
    }

    public function create(array $data): Compressor
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);

        $data['name_slug'] = Str::nameSlug([(string) ($data['name'] ?? '')], Compressor::class);

        $this->compressor = new Compressor();
        $this->compressor->fill($data);
        $this->compressor->save();
        $this->compressor->attachments()->sync($attachmentIds);

        return $this->compressor;
    }

    public function update(array $data): Compressor
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);

        unset($data['name_slug']);

        $this->compressor->fill($data);
        $this->compressor->save();
        $this->compressor->attachments()->sync($attachmentIds);

        return $this->compressor;
    }

    public function delete(): bool
    {
        return $this->compressor->delete();
    }

    protected function normalizeAttachmentIds(mixed $attachmentIds): array
    {
        if (!is_array($attachmentIds)) {
            return [];
        }

        return collect($attachmentIds)
            ->map(fn ($id) => (int) $id)
            ->filter(fn ($id) => $id > 0)
            ->values()
            ->all();
    }
}
