<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function getBlade(): View
    {
        return view('home');
    }

    public function getContactBlade(): View
    {
        return view('contact');
    }

    public function submitGeneralContact(Request $request): JsonResponse
    {
        // TODO: implement general contacts form submission.
        return response()->json(['status' => 'todo'], 202);
    }

    public function submitQuoteRequest(Request $request): JsonResponse
    {
        // TODO: implement quote request form submission.
        return response()->json(['status' => 'todo'], 202);
    }
}
