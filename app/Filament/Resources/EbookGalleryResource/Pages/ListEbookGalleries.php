<?php

namespace App\Filament\Resources\EbookGalleryResource\Pages;

use App\Filament\Resources\EbookGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEbookGalleries extends ListRecords
{
    protected static string $resource = EbookGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
