<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ShortLink;
use App\Models\LinkVisit;

class MyStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();

        $links = ShortLink::where('user_id', $userId);

        $linksCount = $links->count();

        $visitsCount = LinkVisit::whereIn(
            'short_link_id',
            $links->pluck('id')
        )->count();

        return [
            Stat::make('Мои ссылки', $linksCount)
                ->icon('heroicon-o-link'),

            Stat::make('Мои переходы', $visitsCount)
                ->icon('heroicon-o-cursor-arrow-rays'),

            Stat::make(
                'Среднее кликов',
                $linksCount > 0
                    ? round($visitsCount / $linksCount, 2)
                    : 0
            )->icon('heroicon-o-chart-bar'),
        ];
    }
}
