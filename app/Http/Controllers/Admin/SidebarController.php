<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SidebarController extends Controller
{
    public function badges(): JsonResponse
    {
        return response()->json([]);
    }
}
