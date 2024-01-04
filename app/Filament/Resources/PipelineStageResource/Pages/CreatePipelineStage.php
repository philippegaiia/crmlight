<?php

namespace App\Filament\Resources\PipelineStageResource\Pages;

use Filament\Actions;
use App\Models\PipelineStage;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PipelineStageResource;

class CreatePipelineStage extends CreateRecord
{
    protected static string $resource = PipelineStageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['position'] = PipelineStage::max('position') + 1;
        
        return $data;
    }
}
