<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Attachment.
 */
class Attachment extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'mime',
        'extension',
        'size',
        'path',
        'description',
        'hash',
        'disk',
        'was_scanned',
        'is_safe',
        'antivirus_info',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'was_scanned' => 'boolean',
        'is_safe' => 'boolean',
        'antivirus_info' => 'array',
    ];


    public function url(?string $default = null): ?string
    {

        $disk = Storage::disk($this->getAttribute('disk'));
        $path = $this->physicalPath();

        if($path === null){
            return $default;
        }

        $url = $disk->url($path);

        // Проверяем, начинается ли URL с http:// или https://
        if (!preg_match('/^https?:\/\//', $url)) {
            // Определяем текущую среду
            $protocol = app()->environment('production') ? 'https://' : 'http://';
            $url = $protocol . ltrim($url, '/');
        }

        return $url;
    }

    public function getUrlAttribute(): ?string
    {
        return $this->url();
    }

    public function getRelativeUrlAttribute(): ?string
    {
        $url = $this->url();

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        return parse_url($url, PHP_URL_PATH);
    }

    public function getTitleAttribute(): ?string
    {
        return $this->name.'.'.$this->extension;
    }

    public function physicalPath(): ?string
    {
        if ($this->path === null || $this->name === null) {
            return null;
        }

        return $this->path.$this->name.'.'.$this->extension;
    }

    public function relationships(): HasMany
    {
        return $this->hasMany(Attachmentable::class, 'attachment_id');
    }

    public function isMime(string $type): bool
    {
        return Str::of($this->mime)->is($type);
    }

    /**
     * @return bool
     */
    public function isPhysicalExists(): bool
    {
        return Storage::disk($this->disk)->exists($this->physicalPath());
    }

    public function download(array $headers = [])
    {
        return Storage::disk($this->disk)->download($this->physicalPath(), $this->original_name, $headers);
    }

    public function previews(): HasMany
    {
        return $this->hasMany(self::class, 'original_id');
    }
}
