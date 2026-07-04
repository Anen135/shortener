<?php

namespace App\Filament\Resources\ShortLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Illuminate\Support\Str;
use App\Filament\Resources\ShortLinks\ShortLinkResource;

class ShortLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('original_url')
                    ->label('Original URL')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->original_url)
                    ->url(fn ($record) => $record->original_url)
                    ->openUrlInNewTab()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('short_url')
                    ->label('Short Link')
                    ->formatStateUsing(fn ($state) => url($state))
                    ->copyable()
                    ->copyMessage('Copied!')
                    ->url(fn ($record) => url($record->short_url))
                    ->openUrlInNewTab()
                    ->searchable()
                    ->color('primary')
                    ->weight('bold'),

                TextColumn::make('clicks_count')
                    ->label('Clicks')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state >= 100 => 'success',
                        $state >= 10 => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->label(''),
                EditAction::make()->label(''),

                Action::make('open')
                ->label('')
                ->icon('heroicon-m-link')
                ->modalHeading("Open Short Link ")
                ->modalSubheading(fn ($record) => "Are you sure you want to open the short link {$record->short_url}?")
                ->modalButton('Open')
                ->action(function ($record, $livewire) {
                    $url = url($record->short_url);
                    $livewire->dispatch('open-short-link', url: $url);
                })
                ->extraAttributes(function ($record) {
                    $url = url($record->short_url);
                    return [
                        'x-on:open-short-link.window' => "if (\$event.detail.url === '{$url}') window.open('{$url}', '_blank')"
                    ];
                }),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
