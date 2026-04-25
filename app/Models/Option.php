<?php

namespace App\Models;

use App\Traits\Attachable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use Attachable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_slug',
        'published',
        'eco',
        'icon_attachment_id',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(OptionPost::class)->orderBy('name');
    }

    public function iconAttachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'icon_attachment_id');
    }
}
