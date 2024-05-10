<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreparerResource\Pages;
use App\Filament\Resources\PreparerResource\RelationManagers;
use App\Models\Preparer;
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

class PreparerResource extends Resource
{
    protected static ?string $model = Preparer::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?int $navigationSort = 3;

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
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('movil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street_number_mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_home_mail')
                    ->searchable(),
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
            ])
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
            'index' => Pages\ListPreparers::route('/'),
            'create' => Pages\CreatePreparer::route('/create'),
            'edit' => Pages\EditPreparer::route('/{record}/edit'),
        ];
    }
}
