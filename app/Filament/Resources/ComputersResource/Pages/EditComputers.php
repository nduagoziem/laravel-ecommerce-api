<?php

namespace App\Filament\Resources\ComputersResource\Pages;

use App\Filament\Resources\ComputersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComputers extends EditRecord
{
    protected static string $resource = ComputersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
