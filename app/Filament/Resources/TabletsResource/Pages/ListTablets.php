<?php

namespace App\Filament\Resources\TabletsResource\Pages;

use App\Filament\Resources\TabletsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTablets extends ListRecords
{
    protected static string $resource = TabletsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
