<?php

namespace App\Filament\Resources\ContactPageResource\Pages;

use App\Filament\Resources\ContactPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageContactPages extends ManageRecords
{
    protected static string $resource = ContactPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
