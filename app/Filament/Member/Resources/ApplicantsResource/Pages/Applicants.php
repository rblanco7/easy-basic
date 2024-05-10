<?php

namespace App\Filament\Member\Resources\ApplicantsResource\Pages;

use App\Filament\Member\Resources\ApplicantsResource;
use Filament\Resources\Pages\Page;

class Applicants extends Page
{
    protected static string $resource = ApplicantsResource::class;

    protected static string $view = 'filament.member.resources.applicants-resource.pages.applicants';
}
