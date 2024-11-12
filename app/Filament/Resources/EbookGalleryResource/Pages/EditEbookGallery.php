<?php

namespace App\Filament\Resources\EbookGalleryResource\Pages;

use App\Filament\Resources\EbookGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEbookGallery extends EditRecord
{
    protected static string $resource = EbookGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
