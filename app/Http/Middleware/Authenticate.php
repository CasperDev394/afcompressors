<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo(\Illuminate\Http\Request $request)
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('login'); // Только админов редиректим
        }

        return null;
    }
}
