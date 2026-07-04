<?php

namespace App\Filament\Widgets;

use App\Models\LinkVisit;
use Filament\Widgets\ChartWidget;

class LinkVisitsChart extends ChartWidget
{
    protected ?string $heading = 'Мои переходы по дням';

    protected function getData(): array
    {
        $userId = auth()->id();

        $data = LinkVisit::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereHas('shortLink', fn ($q) => $q->where('user_id', $userId))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        return [
            'datasets' => [
                [
                    'label' => 'Переходы',
                    'data' => $data->values()->toArray(),

                    // ✨ делает линию плавной (визуально сильно красивее)
                    'tension' => 0.4,

                    // ✨ лёгкая заливка под линией (очень "SaaS style")
                    'fill' => true,
                ],
            ],

            'labels' => $data->keys()->map(function ($date) {
                return date('d M', strtotime($date));
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
