<?php

namespace App\Models;

use App\Traits\Attachable;
use Illuminate\Database\Eloquent\Model;

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

}
