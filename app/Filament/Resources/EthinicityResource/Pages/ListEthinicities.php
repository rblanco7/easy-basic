<?php

namespace App\Filament\Resources\EthinicityResource\Pages;

use App\Filament\Resources\EthinicityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEthinicities extends ListRecords
{
    protected static string $resource = EthinicityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
