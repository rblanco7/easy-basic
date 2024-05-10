<?php

namespace App\Filament\Member\Resources\CasesResource\Pages;

use App\Filament\Member\Resources\CasesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCases extends EditRecord
{
    protected static string $resource = CasesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
