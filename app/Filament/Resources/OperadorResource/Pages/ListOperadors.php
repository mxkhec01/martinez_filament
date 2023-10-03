<?php

namespace App\Filament\Resources\OperadorResource\Pages;

use App\Filament\Resources\OperadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOperadors extends ListRecords
{
    protected static string $resource = OperadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
