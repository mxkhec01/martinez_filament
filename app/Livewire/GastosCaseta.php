<?php

namespace App\Livewire;

use App\Models\EvidenciaCaseta;
use App\Models\EvidenciaOtro;
use App\Models\Viaje;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Filament\Tables\Table;

class GastosCaseta extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public int $viaje_id;
    private float $viajeGasto;


    public function mount(): void
    {
        $this->viajeGasto = Viaje::find($this->viaje_id)->casetas()->sum('monto');
    }

    public function render()
    {
        return view('livewire.casetas-gastos', [
            'viajeGasto' => $this->viajeGasto,
            'viajeId' => $this->viaje_id,
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(EvidenciaCaseta::query()
                ->with(['viaje'])
                ->where(['viaje_id' => $this->viaje_id,])
            )
            ->columns([
                TextColumn::make('lugar'),
                TextColumn::make('monto')
                    ->money('MXN')
                    ->numeric('2', '.', ','),
                ToggleColumn::make('tag')
                ->label('Pago con Tag')
                ->disabled(true),

            ])
            ->paginated(false)
            ;
    }

//cambio nuevo
}

