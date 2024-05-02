<?php

namespace App\Filament\Resources\ColoreyeResource\Pages;

use App\Filament\Resources\ColoreyeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditColoreye extends EditRecord
{
    protected static string $resource = ColoreyeResource::class;

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
