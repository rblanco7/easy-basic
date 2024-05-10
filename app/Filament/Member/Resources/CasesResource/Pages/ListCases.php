<?php

namespace App\Filament\Member\Resources\CasesResource\Pages;

use App\Filament\Member\Resources\CasesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCases extends ListRecords
{
    protected static string $resource = CasesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
