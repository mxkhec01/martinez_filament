<?php

namespace App\Livewire;

use App\Models\Viaje;
use App\Models\EvidenciaCombustible;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Filament\Tables\Table;
use stdClass;

class GastosCombustible extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public int $viaje_id;
    public array $viajeGasto;
    public int $kilometroAnterior;

    public float $calculoRendimiento;


    public function mount(): void
    {
        $this->viajeGasto = EvidenciaCombustible::groupBy('convenio')
            ->where('viaje_id', $this->viaje_id)
            ->selectRaw('SUM(monto) as monto, convenio')
            ->pluck('monto', 'convenio')
            ->toArray();
        $this->kilometroAnterior = 0;
        $this->calculoRendimiento = 0;
    }


    public function render()
    {
        return view('livewire.combustibles-gastos', [
            'viajeGasto' => $this->viajeGasto,
            'viajeId' => $this->viaje_id,
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(EvidenciaCombustible::query()
//                ->with(['viaje'])
                ->where(['viaje_id' => $this->viaje_id,])
            )
            ->columns([
                TextColumn::make('litros'),
                TextColumn::make('km'),
                TextColumn::make('monto')
                    ->money('MXN')
                    ->alignEnd(),
                IconColumn::make('convenio')
                    ->label('En Convenio')
                    ->boolean()
                    ->sortable()
                    ->alignCenter()
                ,
                TextColumn::make('rendimiento')
                    ->color(function ($record) {
                        Log::debug('Entra en loop Combustible: ' . $record->id);
                        if (($this->kilometroAnterior) != 0 && ($record->litros > 0)) {
                            $this->calculoRendimiento = ($this->kilometroAnterior - $record->km) / $record->id;

                        }
                        $this->kilometroAnterior = $record->km;
                        return 'gray';
                    })
                    ->state(fn($record) =>( $record->km - ($this->kilometroAnterior > 0 ? $this->kilometroAnterior : $record->km) ) / $record->litros)
                ->alignEnd()
                ->numeric(2),

            ])
            ->paginated(false);
    }

//cambio nuevo
}
