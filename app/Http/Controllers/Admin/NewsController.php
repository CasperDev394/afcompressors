<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\NewsResource;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function getList()
    {
        $news = News::query()
            ->orderByDesc('id')
            ->get();

        return NewsResource::collection($news);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'published' => ['nullable', 'boolean'],
            'attachment_ids' => ['nullable', 'array'],
            'attachment_ids.*' => ['integer'],
        ])->validate();

        $validated['published'] = (bool) ($validated['published'] ?? false);

        (new NewsService())->create($validated);

        return response()->json(['status' => 'ok']);
    }

    public function read(News $news): NewsResource
    {
        $news->load('attachments');

        return new NewsResource($news);
    }

    public function update(Request $request, News $news): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'published' => ['nullable', 'boolean'],
            'attachment_ids' => ['nullable', 'array'],
            'attachment_ids.*' => ['integer'],
        ])->validate();

        $validated['published'] = (bool) ($validated['published'] ?? false);

        (new NewsService($news))->update($validated);

        return response()->json(['status' => 'ok']);
    }

    public function delete(News $news): JsonResponse
    {
        (new NewsService($news))->delete();

        return response()->json(['status' => 'ok']);
    }
}
