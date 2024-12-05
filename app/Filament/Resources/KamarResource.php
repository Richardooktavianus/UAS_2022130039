<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KamarResource\Pages;
use App\Filament\Resources\KamarResource\RelationManagers;
use App\Models\Kamar;
use App\Models\Kategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KamarResource extends Resource
{
    protected static ?string $model = Kamar::class;

    protected static ?string $navigationIcon = 'heroicon-s-ticket';

    protected static ?string $navigationLabel = 'Kamar';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('nomor_kamar')
                ->required()
                ->label('Nomor Kamar'),

            Forms\Components\Select::make('status')
                ->options([
                    'tersedia' => 'Tersedia',
                    'tidak_tersedia' => 'Tidak Tersedia',
                ])
                ->default('tersedia')
                ->required()
                ->label('Status'),

            Forms\Components\Select::make('kategori_id')
                ->label('Kategori')
                ->options(Kategori::pluck('nama_kategori', 'id'))
                ->required()
                ->reactive() // Menjadikan field reactive untuk memicu update
                ->afterStateUpdated(function (callable $set, $state) {
                    // Ambil harga kategori dan set field harga
                    if ($kategori = Kategori::find($state)) {
                        $set('harga', $kategori->total_harga);
                    } else {
                        $set('harga', null); // Reset jika kategori tidak valid
                    }
                }),

            Forms\Components\TextInput::make('harga')
                ->label('Harga')
                ->numeric()
                ->disabled() // Agar tidak bisa diubah oleh pengguna
                ->required(),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_kamar')->limit(50),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')->limit(50),
                Tables\Columns\TextColumn::make('kategori.total_harga')->label('Total Harga')->limit(50)
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('status'),
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
            'index' => Pages\ListKamars::route('/'),
            'create' => Pages\CreateKamar::route('/create'),
            'view' => Pages\ViewKamar::route('/{record}'),
            'edit' => Pages\EditKamar::route('/{record}/edit'),
        ];
    }
}

