<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use App\Models\ShortLink;
use App\Models\LinkVisit;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GlobalStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $linksCount = ShortLink::count();
        $visitsCount = LinkVisit::count();

        return [
            Stat::make('Ссылок', number_format($linksCount))
                ->description('Всего создано')
                ->icon('heroicon-o-link'),

            Stat::make('Переходов', number_format($visitsCount))
                ->description('Всего посещений')
                ->icon('heroicon-o-cursor-arrow-rays'),

            Stat::make('Пользователей', number_format(User::count()))
                ->description('Зарегистрировано')
                ->icon('heroicon-o-users'),

            Stat::make(
                'Среднее кликов',
                $linksCount > 0
                    ? number_format($visitsCount / $linksCount, 2)
                    : '0'
            )
                ->description('На одну ссылку')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
