<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Compressor;
use App\Models\Option;
use App\Models\OptionPost;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RelationServiceProvider extends ServiceProvider
{
    public function register(){ }
    public function boot()
    {
        Relation::morphMap([
            'ADMIN' => Admin::class,
            'COMPRESSOR' => Compressor::class,
            'OPTION' => Option::class,
            'OPTION_POST' => OptionPost::class,
        ]);
    }
}
