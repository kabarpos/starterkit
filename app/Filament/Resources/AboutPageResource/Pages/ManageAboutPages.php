<?php

namespace App\Filament\Resources\AboutPageResource\Pages;

use App\Filament\Resources\AboutPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAboutPages extends ManageRecords
{
    protected static string $resource = AboutPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
