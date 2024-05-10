<?php

namespace App\Filament\Resources\PreparerResource\Pages;

use App\Filament\Resources\PreparerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePreparer extends CreateRecord
{
    protected static string $resource = PreparerResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
