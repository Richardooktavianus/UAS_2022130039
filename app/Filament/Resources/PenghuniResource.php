<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenghuniResource\Pages;
use App\Filament\Resources\PenghuniResource\RelationManagers;
use App\Models\Penghuni;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenghuniResource extends Resource
{
    protected static ?string $model = Penghuni::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama'),
                Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'laki-laki' => 'Laki-laki',
                        'perempuan' => 'Perempuan',
                    ])
                    ->default('pilih'),
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat'),
                Forms\Components\TextInput::make('no_telepon')
                    ->label('No Telepon'),
                Forms\Components\TextInput::make('status')
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\TextColumn::make('no_telepon'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPenghunis::route('/'),
            'create' => Pages\CreatePenghuni::route('/create'),
            'view' => Pages\ViewPenghuni::route('/{record}'),
            'edit' => Pages\EditPenghuni::route('/{record}/edit'),
        ];
    }
}
