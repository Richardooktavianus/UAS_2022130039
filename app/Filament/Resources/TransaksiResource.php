<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Penghuni;
use App\Models\Sewa;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sewa_id')
    ->label('ID Sewa')
    ->options(Sewa::pluck('id', 'id'))
    ->reactive()
    ->required()
    ->afterStateUpdated(function (callable $set, $state) {
        // Fetch related Sewa record
        $sewa = Sewa::find($state);

        if ($sewa) {
            $set('penghuni_id', $sewa->penghuni_id);
            $set('tanggal_sewa', $sewa->tanggal_mulai);

            // Check if the 'kategori' relation is valid and has 'harga_per_bulan'
            if ($sewa->kategori) {
                $set('jumlah_bayar', $sewa->kategori->harga_per_bulan);
            } else {
                $set('jumlah_bayar', null);  // Or a default value, depending on your needs
            }
        } else {
            $set('penghuni_id', null);
            $set('tanggal_sewa', null);
            $set('jumlah_bayar', null);
        }
                    }),

                Forms\Components\Select::make('penghuni_id')
                    ->label('Penghuni')
                    ->options(Penghuni::pluck('nama', 'id'))
                    ->required()
                    ->disabled(),

                Forms\Components\DatePicker::make('tanggal_transaksi')
                    ->label('Tanggal Transaksi')
                    ->required()
                    ->default(now()),

                Forms\Components\TextInput::make('jumlah_bayar')
                    ->label('Jumlah Bayar')
                    ->required()
                    ->disabled(),

                Forms\Components\Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'tunai' => 'Tunai',
                        'transfer' => 'Transfer',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('keterangan')
                    ->label('Keterangan')
                    ->maxLength(255),

                Forms\Components\Select::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'proses' => 'Proses',
                        'lunas' => 'Lunas',
                        'belum_bayar' => 'Belum Bayar',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sewa.id')->label('ID Sewa'),
                Tables\Columns\TextColumn::make('tanggal_sewa')->label('Tanggal Sewa'),
                Tables\Columns\TextColumn::make('jumlah_bayar')->label('Total Bayar'),
                Tables\Columns\TextColumn::make('metode_pembayaran')->label('Metode Pembayaran'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'view' => Pages\ViewTransaksi::route('/{record}'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
