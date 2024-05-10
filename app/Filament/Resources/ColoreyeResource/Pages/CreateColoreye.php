<?php

namespace App\Filament\Resources\ColoreyeResource\Pages;

use App\Filament\Resources\ColoreyeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateColoreye extends CreateRecord
{
    protected static string $resource = ColoreyeResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
