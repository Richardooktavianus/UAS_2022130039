<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetugasResource\Pages;
use App\Filament\Resources\PetugasResource\RelationManagers;
use App\Models\Petugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetugasResource extends Resource
{
    protected static ?string $model = Petugas::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_petugas'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('no_telepon'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_petugas'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('no_telepon'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPetugas::route('/'),
            'create' => Pages\CreatePetugas::route('/create'),
            'view' => Pages\ViewPetugas::route('/{record}'),
            'edit' => Pages\EditPetugas::route('/{record}/edit'),
        ];
    }
}
