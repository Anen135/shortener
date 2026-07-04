<?php

namespace App\Filament\Resources\ShortLinks\Pages;

use App\Filament\Resources\ShortLinks\ShortLinkResource;
use App\Filament\Resources\ShortLinks\RelationManagers\VisitsRelationManager;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewShortLink extends ViewRecord
{
    protected static string $resource = ShortLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [
            VisitsRelationManager::class,
        ];
    }
}
