<?php

namespace App\Models;

use App\Traits\Attachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use Attachable;
    use SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'name',
        'name_slug',
        'description',
        'published',
    ];
}
