<?php

namespace App\Filament\Resources\EthinicityResource\Pages;

use App\Filament\Resources\EthinicityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEthinicity extends EditRecord
{
    protected static string $resource = EthinicityResource::class;

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
