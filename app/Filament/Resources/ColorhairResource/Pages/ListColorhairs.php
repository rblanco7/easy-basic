<?php

namespace App\Filament\Resources\ColorhairResource\Pages;

use App\Filament\Resources\ColorhairResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListColorhairs extends ListRecords
{
    protected static string $resource = ColorhairResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
