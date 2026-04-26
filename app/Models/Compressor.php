<?php

namespace App\Models;

use App\Traits\Attachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compressor extends Model
{
    use Attachable;

    protected $fillable = [
        'name',
        'name_slug',
        'pressure_category',
        'published',
        'msf',
        'capacities_iso',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(CompressorModel::class, 'compressor_id')->orderBy('name');
    }
}
