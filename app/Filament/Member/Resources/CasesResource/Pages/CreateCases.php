<?php

namespace App\Filament\Member\Resources\CasesResource\Pages;

use App\Filament\Member\Resources\CasesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCases extends CreateRecord
{
    protected static string $resource = CasesResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status']='INITIATED';
        return $data;
    }
}
