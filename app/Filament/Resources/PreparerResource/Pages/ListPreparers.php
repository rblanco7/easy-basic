<?php

namespace App\Filament\Resources\PreparerResource\Pages;

use App\Filament\Resources\PreparerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreparers extends ListRecords
{
    protected static string $resource = PreparerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
