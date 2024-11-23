<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $monthlyPostCounts = Transaksi::selectRaw('count(*) as count, MONTH(tanggal_transaksi) as month')
            ->groupByRaw('MONTH(tanggal_transaksi)')
            ->get()
            ->pluck('count')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Transaksi',
                    'data' => $monthlyPostCounts,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

