<?php

namespace App\Filament\Resources\TypecaseResource\Pages;

use App\Filament\Resources\TypecaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTypecase extends CreateRecord
{
    protected static string $resource = TypecaseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
