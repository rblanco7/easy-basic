<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColoreyeResource\Pages;
use App\Filament\Resources\ColoreyeResource\RelationManagers;
use App\Models\Coloreye;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ColoreyeResource extends Resource
{
    protected static ?string $model = Coloreye::class;
    //protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = 'Eyes Color';
    protected static ?string $navigationLabel = 'Eyes Color';
    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?int $navigationSort = 22;

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
            'index' => Pages\ListColoreyes::route('/'),
            'create' => Pages\CreateColoreye::route('/create'),
            'edit' => Pages\EditColoreye::route('/{record}/edit'),
        ];
    }
}
