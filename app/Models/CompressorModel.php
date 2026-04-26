<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompressorModel extends Model
{
    use SoftDeletes;

    protected $table = 'models';

    protected $fillable = [
        'name',
        'compressor_id',
        'capacity',
        'FAD',
        'CFM',
        'installed_power',
    ];

    public function compressor(): BelongsTo
    {
        return $this->belongsTo(Compressor::class, 'compressor_id');
    }
}
