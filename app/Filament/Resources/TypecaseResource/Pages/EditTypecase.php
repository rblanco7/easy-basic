<?php

namespace App\Filament\Resources\TypecaseResource\Pages;

use App\Filament\Resources\TypecaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypecase extends EditRecord
{
    protected static string $resource = TypecaseResource::class;

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
