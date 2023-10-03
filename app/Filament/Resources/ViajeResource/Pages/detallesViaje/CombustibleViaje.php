<?php

namespace App\Filament\Resources\ViajeResource\Pages\detallesViaje;

use App\Filament\Resources\ViajeResource;
use App\Filament\Resources\ViajeResource\Pages\ViewViaje;
use App\Models\Viaje;
use Filament\Support\Components\ViewComponent;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Relations\HasMany;




class CombustibleViaje extends ViewRecord implements hasTable
{
    use InteractsWithTable;

    protected static string $resource = ViajeResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn (): HasMany => $this->record->combustibles())
            ->columns([
                TextColumn::make('monto')
                    ->money('MXN'),
                TextColumn::make('km'),
                TextColumn::make('litros'),
            ])
            ->paginated(false )
            ;
    }
//    protected static string $view = 'filament.resources.viajes.pages.view-viaje';
}
