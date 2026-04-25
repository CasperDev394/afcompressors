<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OptionResource;
use App\Models\Option;
use App\Services\OptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionsController extends Controller
{
    public function getList()
    {
        $options = Option::query()
            ->orderBy('name')
            ->get();

        return OptionResource::collection($options);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'published' => ['nullable', 'boolean'],
            'icon_attachment_id' => ['nullable', 'integer'],
            'attachment_ids' => ['nullable', 'array'],
            'attachment_ids.*' => ['integer'],
        ])->validate();

        $validated['published'] = (bool) ($validated['published'] ?? false);

        (new OptionService())->create($validated);

        return response()->json(['status' => 'ok']);
    }

    public function read(Option $option): OptionResource
    {
        $option->load(['attachments', 'iconAttachment', 'posts.attachments']);

        return new OptionResource($option);
    }

    public function update(Request $request, Option $option): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'published' => ['nullable', 'boolean'],
            'icon_attachment_id' => ['nullable', 'integer'],
            'attachment_ids' => ['nullable', 'array'],
            'attachment_ids.*' => ['integer'],
        ])->validate();

        $validated['published'] = (bool) ($validated['published'] ?? false);

        (new OptionService($option))->update($validated);

        return response()->json(['status' => 'ok']);
    }

    public function delete(Option $option): JsonResponse
    {
        (new OptionService($option))->delete();

        return response()->json(['status' => 'ok']);
    }
}
