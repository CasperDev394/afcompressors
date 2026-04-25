<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OptionPostResource;
use App\Models\Option;
use App\Models\OptionPost;
use App\Services\OptionPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionPostsController extends Controller
{
    public function create(Request $request, Option $option): OptionPostResource
    {
        $validated = $this->validatePayload($request);
        $validated['published'] = (bool) ($validated['published'] ?? false);

        $post = (new OptionPostService())->create($option, $validated);
        $post->load('attachments');

        return new OptionPostResource($post);
    }

    public function update(Request $request, Option $option, OptionPost $post): OptionPostResource
    {
        abort_if((int) $post->option_id !== (int) $option->id, 404);

        $validated = $this->validatePayload($request);
        $validated['published'] = (bool) ($validated['published'] ?? false);

        $post = (new OptionPostService($post))->update($validated);
        $post->load('attachments');

        return new OptionPostResource($post);
    }

    public function delete(Option $option, OptionPost $post): JsonResponse
    {
        abort_if((int) $post->option_id !== (int) $option->id, 404);

        (new OptionPostService($post))->delete();

        return response()->json(['status' => 'ok']);
    }

    protected function validatePayload(Request $request): array
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'published' => ['nullable', 'boolean'],
            'attachment_ids' => ['nullable', 'array'],
            'attachment_ids.*' => ['integer'],
        ])->validate();
    }
}
