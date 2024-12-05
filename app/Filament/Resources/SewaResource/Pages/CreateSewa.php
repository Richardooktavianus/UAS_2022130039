<?php

namespace App\Filament\Resources\SewaResource\Pages;

use App\Filament\Resources\SewaResource;
use App\Models\Kamar;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSewa extends CreateRecord
{
    protected static string $resource = SewaResource::class;

    protected function afterCreate(): void
    {
        $kamar = Kamar::find($this->record->kamar_id);
        $kamar->update(['status' => 'Tidak Tersedia']);

    }
}
