<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SewaResource\Pages;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Sewa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SewaResource extends Resource
{
    protected static ?string $model = Sewa::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('penghuni_id')
                ->label('Penghuni')
                ->options(Penghuni::pluck('nama', 'id'))
                ->required(),

            Forms\Components\Select::make('kamar_id')
                ->label('Kamar')
                ->options(Kamar::pluck('nomor_kamar', 'id'))
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $kamarId = $get('kamar_id');
                    $lamaSewa = $get('lama_sewa');

                    if ($kamarId && $lamaSewa) {
                        $kamar = Kamar::with('kategori')->find($kamarId);
                        if ($kamar && $kamar->kategori) {
                            $kategoriHarga = $kamar->kategori->total_harga;
                            $totalHarga = $lamaSewa * $kategoriHarga;
                            $set('jumlah_harga', $totalHarga);
                        }
                    }
                }),

            Forms\Components\DatePicker::make('tanggal_mulai')
                ->label('Mulai Sewa')
                ->required()
                ->default(Carbon::now())
                ->displayFormat('d-m-Y')
                ->reactive()
                ->afterStateUpdated(function (callable $get, callable $set) {
                    Log::info('Tanggal Mulai Updated: ' . $get('tanggal_mulai'));
                }),

            Forms\Components\DatePicker::make('tanggal_akhir')
                ->label('Akhir Sewa')
                ->required()
                ->displayFormat('d-m-Y')
                ->reactive()
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $tanggalMulai = $get('tanggal_mulai');
                    $tanggalAkhir = $get('tanggal_akhir');

                    Log::info('Tanggal Akhir Updated: ' . $tanggalAkhir);

                    if ($tanggalMulai && $tanggalAkhir) {
                        $startDate = Carbon::parse($tanggalMulai);
                        $endDate = Carbon::parse($tanggalAkhir);

                        $durationInMonths = $startDate->diffInMonths($endDate);
                        Log::info('Calculated Lama Sewa (months): ' . $durationInMonths);

                        $set('lama_sewa', $durationInMonths);
                    }
                }),

            Forms\Components\TextInput::make('lama_sewa')
                ->label('Lama Sewa (Bulan)')
                ->disabled()
                ->default(0)
                ->suffix('Bulan')
                ->dehydrated()
                ->reactive()
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $lamaSewa = $get('lama_sewa');
                    $kamarId = $get('kamar_id');

                    if ($kamarId && $lamaSewa) {
                        $kamar = Kamar::with('kategori')->find($kamarId);
                        if ($kamar && $kamar->kategori) {
                            $kategoriHarga = $kamar->kategori->total_harga;
                            $totalHarga = $lamaSewa * $kategoriHarga;
                            $set('jumlah_harga', $totalHarga);
                        }
                    }
                }),

            Forms\Components\TextInput::make('jumlah_harga')
                ->label('Total Harga')
                ->disabled()
                ->dehydrated()
                ->default(0)
                ->prefix('Rp')
                ->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penghuni.nama')->label('Penghuni'),
                Tables\Columns\TextColumn::make('kamar.nomor_kamar')->label('Kamar'),
                Tables\Columns\TextColumn::make('tanggal_mulai')->label('Mulai Sewa'),
                Tables\Columns\TextColumn::make('tanggal_akhir')->label('Akhir Sewa'),
                Tables\Columns\TextColumn::make('lama_sewa')
                    ->label('Lama Sewa (Bulan)')
                    ->formatStateUsing(fn (Sewa $record): string => $record->lama_sewa . ' Bulan'),
                Tables\Columns\TextColumn::make('jumlah_harga')
                    ->label('Total Harga')
                    ->money('IDR'),
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
            'index' => Pages\ListSewas::route('/'),
            'create' => Pages\CreateSewa::route('/create'),
            'view' => Pages\ViewSewa::route('/{record}'),
            'edit' => Pages\EditSewa::route('/{record}/edit'),
        ];
    }
}
