<?php

namespace App\Filament\Resources\CitieResource\Pages;

use App\Filament\Resources\CitieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCitie extends EditRecord
{
    protected static string $resource = CitieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
