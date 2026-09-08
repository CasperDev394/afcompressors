<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'home_h1',
        'home_title',
        'home_description',
    ];

    public static function defaults(): array
    {
        return [
            'phone' => '+7 999 999 99 99',
            'email' => 'afcompressors@email.com',
            'home_h1' => 'Energy Sobriety',
            'home_title' => 'AF compressors',
            'home_description' => 'AF compressors',
        ];
    }

    public static function current(): self
    {
        return self::query()->first() ?? new self(self::defaults());
    }
}
