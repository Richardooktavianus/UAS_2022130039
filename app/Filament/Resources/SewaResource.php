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
                ->label('Tanggal Mulai')
                ->required()
                ->reactive(),

            Forms\Components\DatePicker::make('tanggal_akhir')
                ->label('Tanggal Akhir')
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $tanggalMulai = $get('tanggal_mulai');
                    $tanggalAkhir = $get('tanggal_akhir');

                    if ($tanggalMulai && $tanggalAkhir) {
                        $startDate = Carbon::parse($tanggalMulai);
                        $endDate = Carbon::parse($tanggalAkhir);
                        $durationInMonths = $startDate->diffInMonths($endDate);


                        $set('lama_sewa', $durationInMonths);
                    }
                }),

            Forms\Components\TextInput::make('lama_sewa')
                ->label('Lama Sewa (Bulan)')
                ->disabled()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penghuni.nama')->label('Penghuni'),
                Tables\Columns\TextColumn::make('kamar.nomor_kamar')->label('Kamar'),
                Tables\Columns\TextColumn::make('lama_sewa')->label('Lama Sewa (Bulan)'),
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
