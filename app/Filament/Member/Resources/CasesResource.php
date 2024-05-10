<?php

namespace App\Filament\Member\Resources;

use App\Filament\Member\Resources\CasesResource\Pages;
use App\Filament\Member\Resources\CasesResource\RelationManagers;
use App\Models\Cases;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\typecase;
use App\Models\citie;
use App\Models\state;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Collection;


class CasesResource extends Resource
{
    protected static ?string $model = Cases::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('applicants_id')
                    ->searchable()
                    ->relationship('applicants', 'last_name')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->first_name} {$record->last_name} | {$record->email}")
                    ->createOptionModalHeading('Create Applicant')
                    ->createOptionForm([
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
                                ->label('Type of housing')
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
                                ])
                    ->required(),
                Forms\Components\Select::make('typecases_id')
                    ->relationship('typecases', 'form')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->form} | {$record->description}")
                    ->searchable()
                    ->preload()
                    ->createOptionModalHeading('Create Type Cases')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('description')
                            ->label('Description')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('form')
                            ->label('Form')
                            ->required()
                            ->maxLength(255),
                        ])
                    ->required(),
                Forms\Components\Select::make('preparers_id')
                    ->searchable()
                    ->relationship('preparers', 'last_name')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->first_name} {$record->last_name}")
                    ->createOptionModalHeading('Create Preparer')
                    ->createOptionForm([
                        Fieldset::make('Information About You')
                    ->schema([
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
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
                        ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->hiddenOn('create')
                    ->options([
                        'INITIATED' => 'INITIATED',
                        'WAITING' => 'WAITING',
                        'CLOSED' => 'CLOSED', ]),
                /*Forms\Components\Select::make('users_id')
                    ->relationship('users', 'name')
                    ->required(),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('applicants.last_name')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('applicants.first_name')
                    ->label('First Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('typecases.form')
                    ->label('Form')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('typecases.description')
                    ->label('Type Case')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('preparers.last_name')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'INITIATED' => 'gray',
                        'WAITING' => 'warning',
                        'CLOSED' => 'danger',
                    })
                    ->searchable(),
               /*Tables\Columns\TextColumn::make('users.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),*/
            ])
            ->striped()
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'INITIATED' => 'INITIATED',
                        'WAITING' => 'WAITING',
                        'CLOSED' => 'CLOSED',
                    ]),
                SelectFilter::make('typecases_id')
                    ->label('Type Case')
                    ->options(fn (): array => typecase::query()->pluck('description', 'id')->all()),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ],position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCases::route('/'),
            'create' => Pages\CreateCases::route('/create'),
            'edit' => Pages\EditCases::route('/{record}/edit'),
        ];
    }
}
