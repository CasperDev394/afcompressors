<?php

namespace App\Services;

use App\Models\Compressor;
use App\Models\CompressorModel;

class CompressorModelService
{
    protected ?CompressorModel $compressorModel;

    public function __construct(?CompressorModel $compressorModel = null)
    {
        $this->compressorModel = $compressorModel;
    }

    public function create(Compressor $compressor, array $data): CompressorModel
    {
        $data['compressor_id'] = $compressor->id;

        $this->compressorModel = new CompressorModel();
        $this->compressorModel->fill($data);
        $this->compressorModel->save();

        return $this->compressorModel;
    }

    public function update(array $data): CompressorModel
    {
        unset($data['compressor_id']);

        $this->compressorModel->fill($data);
        $this->compressorModel->save();

        return $this->compressorModel;
    }

    public function delete(): bool
    {
        return $this->compressorModel->delete();
    }
}
