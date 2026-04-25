<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function getOptionsBlade(): View
    {
        return view('options', [
            'title' => 'Опции | AF compressors',
            'description' => 'Опции AF compressors',
        ]);
    }

    public function getOptionBlade(Option $option): View
    {
        $this->abortIfOptionUnavailable($option);

        return view('option', [
            'title' => $option->name . ' | AF compressors',
            'description' => $option->name,
            'option' => $option,
        ]);
    }

    public function readOptions(): JsonResponse
    {
        $options = Option::query()
            ->where('published', true)
            ->orderBy('name')
            ->with('iconAttachment')
            ->get();

        return response()->json([
            'data' => $options->map(function (Option $option) {
                return [
                    'id' => $option->id,
                    'name' => $option->name,
                    'name_slug' => $option->name_slug,
                    'eco' => (bool) $option->eco,
                    'icon_attachment' => $option->iconAttachment ? [
                        'id' => $option->iconAttachment->id,
                        'url' => $option->iconAttachment->url,
                        'title' => $option->iconAttachment->title,
                    ] : null,
                ];
            })->values(),
        ]);
    }

    public function readOption(Option $option): JsonResponse
    {
        $this->abortIfOptionUnavailable($option);

        $option->load([
            'iconAttachment',
            'posts' => fn ($query) => $query->where('published', true)->orderBy('id'),
            'posts.attachments',
        ]);

        return response()->json([
            'data' => [
                'id' => $option->id,
                'name' => $option->name,
                'name_slug' => $option->name_slug,
                'icon_attachment' => $option->iconAttachment ? [
                    'id' => $option->iconAttachment->id,
                    'url' => $option->iconAttachment->url,
                    'title' => $option->iconAttachment->title,
                ] : null,
                'posts' => $option->posts->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'name' => $post->name,
                        'description' => $post->description,
                        'image' => optional($post->attachments->first(), function ($attachment) {
                            return [
                                'id' => $attachment->id,
                                'url' => $attachment->url,
                                'title' => $attachment->title,
                            ];
                        }),
                    ];
                })->values(),
            ],
        ]);
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

    protected function abortIfOptionUnavailable(Option $option): void
    {
        if (!$option->published) {
            throw new NotFoundHttpException();
        }
    }
}
