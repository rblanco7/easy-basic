<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CasesResource\Pages;
use App\Filament\Resources\CasesResource\RelationManagers;
use App\Models\Cases;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CasesResource extends Resource
{
    protected static ?string $model = Cases::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('applicants_id')
                    ->relationship('applicants', 'last_name')
                    ->required(),
                Forms\Components\Select::make('typecases_id')
                    ->relationship('typecases', 'description')
                    ->required(),
                Forms\Components\Select::make('preparer_id')
                    ->relationship('preparers', 'last_name')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'INITIATED' => 'INITIATED',
                        'WAITING' => 'WAITING',
                        'CLOSED' => 'CLOSED', ]),
                Forms\Components\Select::make('users_id')
                    ->relationship('users', 'name')
                    ->required(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
        /*->headerActions([
            // ...
            ->button()
        ]),*/

            ->columns([
                Tables\Columns\TextColumn::make('applicants.last_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('typecases.description')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('preparer.last_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('users.name')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\EditAction::make()
                ->modal(),
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
            'index' => Pages\ListCases::route('/'),
            'create' => Pages\CreateCases::route('/create'),
            'edit' => Pages\EditCases::route('/{record}/edit'),
        ];
    }
}
