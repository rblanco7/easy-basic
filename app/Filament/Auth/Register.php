<?php
namespace App\Filament\auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Notifications\Auth\VerifyEmail;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Concerns\HasMaxWidth;
use Filament\Pages\Auth\Register as AuthRegister;

//enum MaxWidth('TwoExtraLarge');


class Register extends AuthRegister
{
    var $MaxWidth='sm:max-w-2xl';
    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Fieldset::make('Information About You')
                ->schema([
                    Forms\Components\TextInput::make('last_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('first_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('company')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\Textarea::make('address')
                        ->maxLength(255)
                        ->default(null),
                ])
                ->columns(2),
                Fieldset::make('Information Login')
                ->schema([
                    $this->getNameFormComponent()
                    ->label('Username'),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),

                ])
                ->columns(2)
                //->maxWidth('TwoExtraLarge'),
        ])
        ->statePath('data');
    }

}
