<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Sewa;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                        $sewa = Sewa::with('kategori')->find($state);

                        if ($sewa) {
                            // Set penghuni, kamar, tanggal_sewa, and jumlah_bayar from Sewa model
                            $set('penghuni_id', $sewa->penghuni_id);
                            $set('kamar_id', $sewa->kamar_id);
                            $set('tanggal_sewa', $sewa->tanggal_mulai);
                            $set('jumlah_bayar', $sewa->kategori->total_harga ?? null); // Ensure jumlah_bayar is set here
                        } else {
                            // Clear fields if no Sewa is found
                            $set('penghuni_id', null);
                            $set('kamar_id', null);
                            $set('tanggal_sewa', null);
                            $set('jumlah_bayar', null);
                        }
                    }),

                Forms\Components\Select::make('penghuni_id')
                    ->label('Penghuni')
                    ->options(Penghuni::pluck('nama', 'id'))
                    ->required()
                    ->disabled(),

                Forms\Components\Select::make('kamar_id')
                    ->label('Kamar')
                    ->options(Kamar::pluck('nomor_kamar', 'id'))
                    ->required()
                    ->disabled(),

                Forms\Components\DatePicker::make('tanggal_transaksi')
                    ->label('Tanggal Transaksi')
                    ->required()
                    ->default(now()),

                Forms\Components\TextInput::make('jumlah_bayar')
                    ->label('Jumlah Bayar')
                    ->disabled()
                    ->default(function (?Transaksi $record): ?int {
                        if ($record && $record->sewa && $record->sewa->kategori) {
                            return $record->sewa->kategori->total_harga ?? null;
                        }
                        return null;
                    })
                    ->afterStateHydrated(function (callable $set, $state) {
                        if ($state && $state->sewa && $state->sewa->kategori) {
                            $set('jumlah_bayar', $state->sewa->kategori->total_harga ?? null);
                        } else {
                            $set('jumlah_bayar', null);
                        }
                    }),

                Forms\Components\Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'tunai' => 'Tunai',
                        'transfer' => 'Transfer',
                    ])
                    ->required(),

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
                Tables\Columns\TextColumn::make('tanggal_transaksi')->label('Tanggal Transaksi'),
                Tables\Columns\TextColumn::make('jumlah_bayar')->label('Jumlah Bayar'),
                Tables\Columns\TextColumn::make('metode_pembayaran')->label('Metode Pembayaran'),
                Tables\Columns\TextColumn::make('status_pembayaran')->label('Status Pembayaran'),
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
