<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CompressorModelResource;
use App\Models\Compressor;
use App\Models\CompressorModel;
use App\Services\CompressorModelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompressorModelsController extends Controller
{
    public function create(Request $request, Compressor $compressor): CompressorModelResource
    {
        $validated = $this->validatePayload($request);

        $model = (new CompressorModelService())->create($compressor, $validated);

        return new CompressorModelResource($model);
    }

    public function update(Request $request, Compressor $compressor, CompressorModel $model): CompressorModelResource
    {
        abort_if((int) $model->compressor_id !== (int) $compressor->id, 404);

        $validated = $this->validatePayload($request);
        $model = (new CompressorModelService($model))->update($validated);

        return new CompressorModelResource($model);
    }

    public function delete(Compressor $compressor, CompressorModel $model): JsonResponse
    {
        abort_if((int) $model->compressor_id !== (int) $compressor->id, 404);

        (new CompressorModelService($model))->delete();

        return response()->json(['status' => 'ok']);
    }

    protected function validatePayload(Request $request): array
    {
        return Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'capacity' => ['nullable', 'numeric'],
            'FAD' => ['nullable', 'integer'],
            'CFM' => ['nullable', 'integer'],
            'installed_power' => ['nullable', 'integer'],
        ])->validate();
    }
}
