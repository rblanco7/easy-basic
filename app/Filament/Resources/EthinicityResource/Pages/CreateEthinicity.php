<?php

namespace App\Filament\Resources\EthinicityResource\Pages;

use App\Filament\Resources\EthinicityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEthinicity extends CreateRecord
{
    protected static string $resource = EthinicityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
