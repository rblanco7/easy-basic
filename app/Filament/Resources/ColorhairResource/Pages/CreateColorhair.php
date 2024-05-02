<?php

namespace App\Filament\Resources\ColorhairResource\Pages;

use App\Filament\Resources\ColorhairResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateColorhair extends CreateRecord
{
    protected static string $resource = ColorhairResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
