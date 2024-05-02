<?php

namespace App\Filament\Resources\CitieResource\Pages;

use App\Filament\Resources\CitieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCitie extends ListRecords
{
    protected static string $resource = CitieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
