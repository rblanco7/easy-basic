<?php

namespace App\Filament\Resources\TypecaseResource\Pages;

use App\Filament\Resources\TypecaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypecases extends ListRecords
{
    protected static string $resource = TypecaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
