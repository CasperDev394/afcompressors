<?php

namespace App\Services;

use App\Helpers\Str;
use App\Models\News;

class NewsService
{
    protected ?News $news;

    public function __construct(?News $news = null)
    {
        $this->news = $news;
    }

    public function create(array $data): News
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);

        $data['name_slug'] = Str::nameSlug([(string) ($data['name'] ?? '')], News::class);

        $this->news = new News();
        $this->news->fill($data);
        $this->news->save();
        $this->news->attachments()->sync($attachmentIds);

        return $this->news;
    }

    public function update(array $data): News
    {
        $attachmentIds = $this->normalizeAttachmentIds($data['attachment_ids'] ?? []);
        unset($data['attachment_ids']);

        unset($data['name_slug']);

        $this->news->fill($data);
        $this->news->save();
        $this->news->attachments()->sync($attachmentIds);

        return $this->news;
    }

    public function delete(): bool
    {
        return $this->news->delete();
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
