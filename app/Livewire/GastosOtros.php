<?php

namespace App\Livewire;

use App\Models\EvidenciaOtro;
use App\Models\Group;
use App\Models\Viaje;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Filament\Tables\Table;

class GastosOtros extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public int $viaje_id;
    public string $tipo_gasto;

    private float $viajeGasto;


    public function mount(): void
    {
        $this->viajeGasto = Viaje::find($this->viaje_id)->gastos()->where('tipo', $this->tipo_gasto)->sum('monto');
    }

    public function render()
    {
        return view('livewire.otros-gastos', [
            'viajeGasto' => $this->viajeGasto,
            'tipoGasto' => $this->tipo_gasto,
            'viajeId' => $this->viaje_id,
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(EvidenciaOtro::query()
                ->with(['viaje'])
                ->where(['viaje_id' => $this->viaje_id,
                    'tipo' => $this->tipo_gasto])

            )
            ->columns([
                TextColumn::make('observaciones'),
                TextColumn::make('monto')
                    ->money('MXN')
                    ->numeric('2', '.', ','),

            ])
            ->paginated(false);
    }


}

