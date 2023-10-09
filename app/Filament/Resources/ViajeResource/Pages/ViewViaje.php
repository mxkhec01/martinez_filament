<?php

namespace App\Filament\Resources\ViajeResource\Pages;

use App\Filament\Resources\ViajeResource;
use App\Models\Viaje;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Filament\Resources\ViajeResource\Pages\detallesViaje\CombustibleViaje;


class ViewViaje extends ViewRecord
{
    protected static string $resource = ViajeResource::class;

    public $combustible = CombustibleViaje::class;

    public function getTablaCombustible(): Table
    {

        $combustible = new CombustibleViaje();

        $combustible->record = $this->record;

        dd($combustible->table);

        return $combustible->table;
    }


//    protected ?string $title = $this->record->id;
    protected static string $view = 'filament.resources.viajes.pages.view-viaje';




    public function getTitle(): string|Htmlable
    {
        //Gastos del viaje 4626 - CELAYA Operador: MIGUEL SANCHEZ HERNANDEZ
        return ('Gastos del viaje ' . $this->record->id . ' - ' . $this->record->destino . ' | Operador: ' . (empty($this->record->operador->nombre) ? '' : $this->record->operador->nombre) );

    }

//    protected function getViewData(): array
//    {
//        return [
//            'viaje' => Viaje::where('id',$this->record->id),
//        ];
//    }


//    public function table(Table $table): Table
//    {
//        return $table
//            ->relationship(fn (): HasMany => $this->record->combustibles())
//            ->columns([
//                TextColumn::make('monto')
//                ->money('MXN'),
//                TextColumn::make('km'),
//                TextColumn::make('litros'),
//            ])
//            ->paginated(false);
//    }


}
