<?php

namespace App\Filament\Resources\ShortLinks\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VisitsRelationManager extends RelationManager
{
    protected static string $relationship = 'visits';

    public function table(Table $table): Table
{
        return $table
            ->columns([
                TextColumn::make('ip_address')
                    ->label('IP')
                    ->searchable(),

                TextColumn::make('visited_at')
                    ->label('Visited at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('visited_at', 'desc');
    }
}
