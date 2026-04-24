<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CompressorResource;
use App\Models\Compressor;
use App\Services\CompressorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompressorsController extends Controller
{
    public function getList()
    {
        $compressors = Compressor::query()
            ->orderBy('name')
            ->get();

        return CompressorResource::collection($compressors);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'attachment_ids' => ['nullable', 'array'],
            'attachment_ids.*' => ['integer'],
        ])->validate();

        (new CompressorService())->create($validated);
        return response()->json(['status' => 'ok']);
    }

    public function read(Compressor $compressor): CompressorResource
    {
        $compressor->load(['attachments']);
        return new CompressorResource($compressor);
    }

    public function update(Request $request, Compressor $compressor): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'attachment_ids' => ['nullable', 'array'],
            'attachment_ids.*' => ['integer'],
        ])->validate();

        (new CompressorService($compressor))->update($validated);
        return response()->json(['status' => 'ok']);
    }

    public function delete(Compressor $compressor): JsonResponse
    {
        (new CompressorService($compressor))->delete();
        return response()->json(['status' => 'ok']);
    }
}
