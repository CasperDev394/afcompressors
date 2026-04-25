<?php

namespace App\Models;

use App\Traits\Attachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionPost extends Model
{
    use Attachable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_slug',
        'description',
        'option_id',
        'published',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }
}
