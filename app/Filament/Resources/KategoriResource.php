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
use Illuminate\Support\Facades\Route;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->required()
                ,
                Forms\Components\TextInput::make('ukuran_kamar')
                    ->label('Ukuran Kamar')
                    ->required(),
                Forms\Components\TextInput::make('harga_per_bulan')
                    ->label('Harga per Bulan')
                    ->required(),
                Forms\Components\Select::make('fasilitas_id')
                    ->label('Fasilitas')
                    ->options(Fasilitas::pluck('nama_fasilitas', 'id')->toArray())
                    ->required(),
                Forms\Components\TextInput::make('deskripsi')
                    ->label('Deskripsi')
                    ->required(),
                Forms\Components\FileUpload::make('photo')
                    ->label('Photo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori'),
                Tables\Columns\TextColumn::make('ukuran_kamar'),
                Tables\Columns\TextColumn::make('harga_per_bulan'),
                Tables\Columns\TextColumn::make('fasilitas.nama_fasilitas'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->getStateUsing(fn ($record) => number_format($record->total_harga, 2)),
                Tables\Columns\TextColumn::make('deskripsi'),
                Tables\Columns\ImageColumn::make('photo'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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


