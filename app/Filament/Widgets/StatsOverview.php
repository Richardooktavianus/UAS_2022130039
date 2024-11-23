<?php

namespace App\Filament\Widgets;

use App\Models\Kamar;
use App\Models\Petugas;
use App\Models\Sewa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Kamar', Kamar::count()),
            Stat::make('Sewa', Sewa::count()),
            Stat::make('Petugas', Petugas::count()),
        ];
    }
}
