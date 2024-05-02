<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitieResource\Pages;
use App\Filament\Resources\CitieResource\RelationManagers;
use App\Models\Citie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CitieResource extends Resource
{
    protected static ?string $model = Citie::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?int $navigationSort = 32;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('state_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('country_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('longitude')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Toggle::make('flag')
                    ->required(),
                Forms\Components\TextInput::make('wikiDataId')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('flag')
                    ->boolean(),
                Tables\Columns\TextColumn::make('wikiDataId')
                    ->searchable(),
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
            'index' => Pages\ListCitie::route('/'),
            'create' => Pages\CreateCitie::route('/create'),
            'edit' => Pages\EditCitie::route('/{record}/edit'),
        ];
    }
}
