<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use App\Models\Customer;
use App\Models\PipelineStage;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CustomerResource;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        $tabs['all'] = Tab::make('All Customers')
            ->badge(Customer::count());

        $pipelineStages = PipelineStage::orderBy('position')->withCount('customers')->get();    

        foreach ($pipelineStages as $pipelineStage) {
            $tabs[str($pipelineStage->name)->slug()->toString()] = Tab::make($pipelineStage->name)
            ->badge($pipelineStage->customers_count)
            ->modifyQueryUsing(function ($query) use ($pipelineStage) {
                return $query->where('pipeline_stage_id', $pipelineStage->id);
            });
        }

        $tabs['archived'] = Tab::make('Archived')
        ->badge(Customer::onlyTrashed()->count())
        ->modifyQueryUsing(function ($query) {
            return $query->onlyTrashed();
        });
        
        return $tabs;
    }
}
