<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Pages\CreateRecord;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;
}
