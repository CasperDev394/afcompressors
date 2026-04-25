<?php

namespace App\Services;

use App\Helpers\Str;
use App\Models\Option;
use App\Models\OptionPost;

class OptionPostService
{
    protected ?OptionPost $optionPost;

    public function __construct(?OptionPost $optionPost = null)
    {
        $this->optionPost = $optionPost;
    }

    public function create(Option $option, array $data): OptionPost
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);

        $data['option_id'] = $option->id;
        $data['name_slug'] = Str::nameSlug([(string) ($data['name'] ?? '')], OptionPost::class);

        $this->optionPost = new OptionPost();
        $this->optionPost->fill($data);
        $this->optionPost->save();
        $this->optionPost->attachments()->sync($attachmentIds);

        return $this->optionPost;
    }

    public function update(array $data): OptionPost
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);
        unset($data['name_slug'], $data['option_id']);

        $this->optionPost->fill($data);
        $this->optionPost->save();
        $this->optionPost->attachments()->sync($attachmentIds);

        return $this->optionPost;
    }

    public function delete(): bool
    {
        return $this->optionPost->delete();
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
