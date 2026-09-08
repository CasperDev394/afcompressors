<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['core.header', 'core.footer'], function ($view) {
            if (! array_key_exists('siteSettings', $view->getData())) {
                $view->with('siteSettings', SiteSetting::current());
            }
        });
    }
}
