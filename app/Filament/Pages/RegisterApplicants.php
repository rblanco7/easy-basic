<?php

use Filament\Forms\Contracts\Hasforms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Applicant;
use App\Models\citie;
use App\Models\state;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Actions\Action;

class Applicants extends Page implements Hasforms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $model = Applicant::class;
   // protected static ?string $view = 'filament.pages.applicants';

     public ?array $data=[];

    public function mount():void
    {
        $this->form->fill();
    }

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
                        Forms\Components\TextInput::make('middle_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'FEMALE' => 'FEMALE',
                                'MALE' => 'MALE', ]),
                        Forms\Components\TextInput::make('number_alien')
                            ->label('Alien Registracion Number (If any)')
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('ssn')
                            ->label('US. Soscial Security Number (If any)')
                            ->maxLength(255)
                            ->default(null),
                    ])
                    ->columns(3),
                ])
                ->statePath('data');
            }
            public function create(): void
            {
                dd($this->form->getState());
               // $data=$this->form->getState();
            }
            protected function getFormActions(): array
            {
                return [
                    Action::make('New')
            ->label(__('filament-panels::resources.pages.create-record.form.actions.create.label'))
            ->submit('New'),
                ];
            }
           /* public function render(): View
            {
                return view('livewire.create-post');
            }*/
}
