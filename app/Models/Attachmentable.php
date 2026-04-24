<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachmentable extends Model
{
    public $timestamps = false;
    protected $table = 'attachmentable';
}
