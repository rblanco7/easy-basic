<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicantResource\Pages;
use App\Filament\Resources\ApplicantResource\RelationManagers;
use App\Models\Applicant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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

class ApplicantResource extends Resource
{
    protected static ?string $model = Applicant::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    //protected static ?string $navigationGroup = 'Users Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
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
                    Fieldset::make('Contact Information')
                        ->schema([
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->placeholder('example@example.com')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('telephone')
                                ->tel()
                                ->mask('(9999) 999-99-99')
                                ->placeholder('(0123) 456-78-90')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('movil')
                                ->tel()
                                ->mask('(9999) 999-99-99')
                                ->placeholder('(0123) 456-78-90')
                                ->maxLength(255)
                                ->default(null),
                    ])
                    ->columns(3),
                    Fieldset::make('Birth Information')
                        ->schema([
                          Forms\Components\DatePicker::make('date_birth'),
                          Forms\Components\Select::make('country_id_birth')
                              ->label('Country of Birth:')
                              ->relationship(name: 'Country_birth', titleAttribute: 'name')
                              ->default('233')
                              ->searchable()
                              ->preload()
                              ->live()
                              ->afterStateUpdated(function (Set $set) {
                                  $set('city_id_birth',null);
                                  $set('state_id_birth',null);
                                  })
                              ->required(),
                          Forms\Components\Select::make('state_id_birth')
                              ->label('State of Birth:')
                              ->options(fn (Get $get): Collection => state::query()
                              ->where('country_id', $get('country_id_birth'))
                              ->pluck('name','id'))
                              ->searchable()
                              ->preload()
                              ->live()
                              ->afterStateUpdated(fn (Set $set) =>$set('city_id_birth',null))
                              ->required(),
                          Forms\Components\Select::make('city_id_birth')
                              ->label('City/Town of Birth:')
                              ->options(fn (Get $get): Collection => citie::query()
                              ->where('state_id', $get('state_id_birth'))
                              ->pluck('name','id'))
                              ->searchable()
                              ->preload()
                              ->required(),
                    ])
                    ->columns(4),
                    Fieldset::make('Mailing Address')
                        ->schema([
                            Forms\Components\TextInput::make('street_number_mail')
                                ->label('Street Number and Name')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\Radio::make('type_home_mail')
                                ->label('Type of housing')
                                ->options([
                                    'APT' => 'APT',
                                    'STE' => 'STE',
                                    'FLR' => 'FLR', ])
                                ->columns(3),
                            Forms\Components\TextInput::make('number_home_mail')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\Select::make('country_id_mail')
                                ->label('Country:')
                                ->relationship(name: 'Country_mail', titleAttribute: 'name')
                                ->default('233')
                                ->searchable()
                                ->preload()
                                ->live()
                                ->afterStateUpdated(function (Set $set) {
                                    $set('city_id_mail',null);
                                    $set('state_id_mail',null);
                                    })
                                ->required(),
                            Forms\Components\Select::make('state_id_mail')
                                ->label('State:')
                                ->options(fn (Get $get): Collection => state::query()
                                ->where('country_id', $get('country_id_mail'))
                                ->pluck('name','id'))
                                ->searchable()
                                ->preload()
                                ->live()
                                ->afterStateUpdated(fn (Set $set) =>$set('city_id_mail',null))
                                ->required(),
                            Forms\Components\Select::make('city_id_mail')
                                ->label('City/Town:')
                                ->options(fn (Get $get): Collection => citie::query()
                                ->where('state_id', $get('state_id_mail'))
                                ->pluck('name','id'))
                                ->searchable()
                                ->preload()
                                ->required(),
                            Forms\Components\TextInput::make('zip_code_mail')
                                ->label('Zip Code')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('postal_code_mail')
                                ->label('Postal Code')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('province_mail')
                                ->label('Province')
                                ->maxLength(255)
                                ->default(null),
                    ])
                    ->columns(3),
                    Fieldset::make('Physical Address')
                        ->schema([
                            Forms\Components\TextInput::make('street_number_physi')
                                ->label('Street Number and Name')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\Radio::make('type_home_physi')
                            ->label('Postal Code')
                                ->options([
                                    'APT' => 'APT',
                                    'STE' => 'STE',
                                    'FLR' => 'FLR', ])
                                ->columns(3),
                            Forms\Components\TextInput::make('number_home_physi')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\Select::make('country_id_physi')
                                ->label('Country:')
                                ->relationship(name: 'Country_physi', titleAttribute: 'name')
                                ->default('233')
                                ->searchable()
                                ->preload()
                                ->live()
                                ->afterStateUpdated(function (Set $set) {
                                    $set('city_id_physi',null);
                                    $set('state_id_physi',null);
                                    })
                                ->required(),
                            Forms\Components\Select::make('state_id_physi')
                                ->label('State:')
                                ->options(fn (Get $get): Collection => state::query()
                                ->where('country_id', $get('country_id_physi'))
                                ->pluck('name','id'))
                                ->searchable()
                                ->preload()
                                ->live()
                                ->afterStateUpdated(fn (Set $set) =>$set('city_id_physi',null))
                                ->required(),
                            Forms\Components\Select::make('city_id_physi')
                                ->label('City/Town:')
                                ->options(fn (Get $get): Collection => citie::query()
                                ->where('state_id', $get('state_id_physi'))
                                ->pluck('name','id'))
                                ->searchable()
                                ->preload()
                                ->required(),
                            Forms\Components\TextInput::make('zip_code_physi')
                                ->label('Zip Code')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('postal_code_physi')
                                ->label('Postal Code')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\TextInput::make('province_physi')
                                ->label('Province')
                                ->maxLength(255)
                                ->default(null),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
               /* Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),*/
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('movil')
                    ->searchable(),
                /*Tables\Columns\TextColumn::make('number_alien')
                    ->searchable(),*/
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('date_birth')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_birth.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city_birth.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ssn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street_number_mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_home_mail'),
                Tables\Columns\TextColumn::make('number_home_mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city_mail.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_mail.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_mail.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('postal_code_mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code_mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province_mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street_number_physi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_home_physi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_home_physi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city_physi.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_physi.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_physi.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('postal_code_physi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code_physi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province_physi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])

            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->schema([
                    // ...
                        Infolists\Components\TextEntry::make('last_name'),
                        Infolists\Components\TextEntry::make('first_name'),
                        Infolists\Components\TextEntry::make('middle_name'),
                        Infolists\Components\TextEntry::make('email'),
                        Infolists\Components\TextEntry::make('telephone'),
                        Infolists\Components\TextEntry::make('movil'),
                        Infolists\Components\TextEntry::make('number_alien')
                            ->label('Alien Registration Number'),
                        Infolists\Components\TextEntry::make('ssn')
                            ->label('US Social Security'),
                        Infolists\Components\TextEntry::make('gender'),
                        Infolists\Components\TextEntry::make('date_birth')
                            ->label('Date of Birth'),
                        Infolists\Components\TextEntry::make('city_birth.name')
                            ->label('City of Birth'),
                        Infolists\Components\TextEntry::make('state_birth.name')
                            ->label('State of Birth'),
                        Infolists\Components\TextEntry::make('country_birth.name')
                            ->label('Country of Birth'),
                ])
                ->columns(3),
                Section::make('Mailingn Address')
                    ->schema([
                        Infolists\Components\TextEntry::make('street_number_mail')
                            ->label('Street Number and Name'),
                        Infolists\Components\TextEntry::make('type_home_mail')
                            ->label('Type of housing'),
                        Infolists\Components\TextEntry::make('number_home_mail'),
                        Infolists\Components\TextEntry::make('city_mail.name')
                            ->label('City'),
                        Infolists\Components\TextEntry::make('state_mail.name')
                            ->label('State'),
                        Infolists\Components\TextEntry::make('country_mail.name')
                            ->label('Country'),
                        Infolists\Components\TextEntry::make('postal_code_mail')
                            ->label('Postal Code'),
                        Infolists\Components\TextEntry::make('zip_code_mail')
                            ->label('Zip Code'),
                        Infolists\Components\TextEntry::make('province_mail')
                            ->label('Provincie'),

                    ])
                    ->columns(3),
                Section::make('Physical Address')
                    ->schema([
                        Infolists\Components\TextEntry::make('street_number_physi')
                            ->label('Street Number and Name'),
                        Infolists\Components\TextEntry::make('type_home_physi')
                            ->label('Type of housing'),
                        Infolists\Components\TextEntry::make('number_home_physi'),
                        Infolists\Components\TextEntry::make('city_physi.name')
                            ->label('City'),
                        Infolists\Components\TextEntry::make('state_physi.name')
                            ->label('State'),
                        Infolists\Components\TextEntry::make('country_physi.name')
                            ->label('Country'),
                        Infolists\Components\TextEntry::make('postal_code_physi')
                            ->label('Postal Code'),
                        Infolists\Components\TextEntry::make('zip_code_physi')
                            ->label('Zip Code'),
                        Infolists\Components\TextEntry::make('province_physi')
                            ->label('Provincie'),

                ])
                ->columns(3),
            ]);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplicants::route('/'),
            'create' => Pages\CreateApplicant::route('/create'),
            'edit' => Pages\EditApplicant::route('/{record}/edit'),
            'view' => Pages\ViewApplicant::route('/{record}'),
        ];
    }
}
