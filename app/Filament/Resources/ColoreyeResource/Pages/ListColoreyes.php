<?php

namespace App\Filament\Resources\ColoreyeResource\Pages;

use App\Filament\Resources\ColoreyeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListColoreyes extends ListRecords
{
    protected static string $resource = ColoreyeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
