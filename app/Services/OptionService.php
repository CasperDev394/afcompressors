<?php

namespace App\Services;

use App\Helpers\Str;
use App\Models\Option;

class OptionService
{
    protected ?Option $option;

    public function __construct(?Option $option = null)
    {
        $this->option = $option;
    }

    public function create(array $data): Option
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);

        $data['name_slug'] = Str::nameSlug([(string) ($data['name'] ?? '')], Option::class);

        $this->option = new Option();
        $this->option->fill($data);
        $this->option->save();
        $this->option->attachments()->sync($attachmentIds);

        return $this->option;
    }

    public function update(array $data): Option
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);

        unset($data['name_slug']);

        $this->option->fill($data);
        $this->option->save();
        $this->option->attachments()->sync($attachmentIds);

        return $this->option;
    }

    public function delete(): bool
    {
        return $this->option->delete();
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
