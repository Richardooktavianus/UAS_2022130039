<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriResource\Pages;
use App\Filament\Resources\KategoriResource\RelationManagers;
use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Petugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori'),
                Forms\Components\TextInput::make('ukuran_kamar'),
                Forms\Components\TextInput::make('harga_per_bulan'),
                Forms\Components\Select::make('fasilitas_id')
                    ->label('Fasilitas')
                    ->relationship('fasilitas', 'nama')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        // Find the associated petugas based on the selected fasilitas
                        $fasilitas = Fasilitas::find($state);
                        if ($fasilitas && $fasilitas->petugas) {
                            $set('petugas_id', $fasilitas->petugas->id); // Automatically set the petugas_id
                        } else {
                            $set('petugas_id', null); // Reset if no petugas found
                        }
                    }),

                // Petugas Select
                Forms\Components\Select::make('petugas_id')
                    ->label('Petugas')
                    ->relationship('petugas', 'nama')
                    ->required()
                    ->disabled(),
                Forms\Components\FileUpload::make('photo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori'),
                Tables\Columns\TextColumn::make('ukuran_kamar'),
                Tables\Columns\TextColumn::make('harga_per_bulan'),
                Tables\Columns\TextColumn::make('fasilitas'),
                Tables\Columns\TextColumn::make('petugas'),
                Tables\Columns\ImageColumn::make('photo'),
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
            'index' => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'view' => Pages\ViewKategori::route('/{record}'),
            'edit' => Pages\EditKategori::route('/{record}/edit'),
        ];
    }
}


