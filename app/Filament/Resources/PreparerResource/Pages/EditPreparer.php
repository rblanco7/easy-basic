<?php

namespace App\Filament\Resources\PreparerResource\Pages;

use App\Filament\Resources\PreparerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreparer extends EditRecord
{
    protected static string $resource = PreparerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
