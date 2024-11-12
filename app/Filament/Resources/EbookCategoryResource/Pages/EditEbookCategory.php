<?php

namespace App\Filament\Resources\EbookCategoryResource\Pages;

use App\Filament\Resources\EbookCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEbookCategory extends EditRecord
{
    protected static string $resource = EbookCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
