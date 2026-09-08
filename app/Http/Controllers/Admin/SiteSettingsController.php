<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function read(): JsonResponse
    {
        return response()->json([
            'data' => SiteSetting::current()->only([
                'phone',
                'email',
                'home_h1',
                'home_title',
                'home_description',
            ]),
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'home_h1' => ['required', 'string', 'max:255'],
            'home_title' => ['required', 'string', 'max:255'],
            'home_description' => ['nullable', 'string', 'max:2000'],
        ]);

        $settings = SiteSetting::query()->first() ?? new SiteSetting;
        $settings->fill($validated);
        $settings->save();

        return response()->json([
            'status' => 'ok',
            'data' => $settings->only([
                'phone',
                'email',
                'home_h1',
                'home_title',
                'home_description',
            ]),
        ]);
    }
}
