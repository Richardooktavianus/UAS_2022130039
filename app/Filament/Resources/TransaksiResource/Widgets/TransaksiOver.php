<?php

namespace App\Filament\Resources\TransaksiResource\Widgets;

use App\Models\Transaksi;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TransaksiOver extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaksi::query()
                    ->select(['id', 'sewa_id','penghuni_id', 'tanggal_transaksi','jumlah_bayar', 'metode_pembayaran', 'status_pembayaran'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('sewa_id')->label('ID Sewa'),
                Tables\Columns\TextColumn::make('tanggal_transaksi')->label('Tanggal Transaksi'),
                Tables\Columns\TextColumn::make('jumlah_bayar')->label('Jumlah Bayar')->money('IDR'),
                Tables\Columns\TextColumn::make('metode_pembayaran')->label('Metode Pembayaran'),
                Tables\Columns\TextColumn::make('status_pembayaran')->label('Status Pembayaran'),
            ]);
    }
}
