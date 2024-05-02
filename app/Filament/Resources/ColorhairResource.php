<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColorhairResource\Pages;
use App\Filament\Resources\ColorhairResource\RelationManagers;
use App\Models\Colorhair;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ColorhairResource extends Resource
{
    protected static ?string $model = Colorhair::class;
    protected static ?string $modelLabel = 'Hair Color';
    protected static ?string $navigationLabel = 'Hair Color';
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'System Management';
   // protected static ?string $navigationParentItem = 'Biometric Data';

    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
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
            'index' => Pages\ListColorhairs::route('/'),
            'create' => Pages\CreateColorhair::route('/create'),
            'edit' => Pages\EditColorhair::route('/{record}/edit'),
        ];
    }
}
