<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SewaResource\Pages;
use App\Filament\Resources\SewaResource\RelationManagers;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Sewa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SewaResource extends Resource
{
    protected static ?string $model = Sewa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                ->required(),


Forms\Components\DatePicker::make('tanggal_mulai')
->label('Mulai Sewa')
->required()
->default(Carbon::now())
->displayFormat('d-m-Y')
->reactive()
->afterStateUpdated(function (callable $get, callable $set) {
    Log::info('Tanggal Mulai Updated: ' . $get('tanggal_mulai')); // Log tanggal_mulai changes
}),

Forms\Components\DatePicker::make('tanggal_akhir')
->label('Akhir Sewa')
->required()
->displayFormat('d-m-Y')
->reactive()
->afterStateUpdated(function (callable $get, callable $set) {
    $tanggalMulai = $get('tanggal_mulai');
    $tanggalAkhir = $get('tanggal_akhir');

    Log::info('Tanggal Akhir Updated: ' . $tanggalAkhir); // Log tanggal_akhir changes

    if ($tanggalMulai && $tanggalAkhir) {
        $startDate = Carbon::parse($tanggalMulai);
        $endDate = Carbon::parse($tanggalAkhir);

        $durationInMonths = $startDate->diffInMonths($endDate);
        Log::info('Calculated Lama Sewa (months): ' . $durationInMonths); // Log calculation

        $set('lama_sewa', $durationInMonths);
    }
}),

Forms\Components\TextInput::make('lama_sewa')
->label('Lama Sewa (Bulan)')
->disabled()
->default(0)
->suffix('Bulan')
->dehydrated(),
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
            'index' => Pages\ListSewas::route('/'),
            'create' => Pages\CreateSewa::route('/create'),
            'view' => Pages\ViewSewa::route('/{record}'),
            'edit' => Pages\EditSewa::route('/{record}/edit'),
        ];
    }
}

