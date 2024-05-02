<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('iso3')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('iso2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phonecode')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('capital')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency_symbol')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tld')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('native')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('region')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subregion')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('timezones')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('translations')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('latitude')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('longitude')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('emoji')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('emojiU')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('flag')
                    ->required(),
                Forms\Components\Textarea::make('wikiDataId')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonecode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tld')
                    ->searchable(),
                Tables\Columns\TextColumn::make('native')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subregion')
                    ->searchable(),
                Tables\Columns\IconColumn::make('flag')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->striped()
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
