<x-filament-panels::page>
    <x-filament::section class="bg-blue-300">
        <x-slot name="description">
            Comentario: {{$record->comentarios}}
        </x-slot>
        @php

            $suma_casetas_efe = $record->casetas->where('tag', '0')->sum('monto');
            $suma_casetas_tag = $record->casetas->where('tag', '1')->sum('monto');

            $suma_combustible_convenio = $record->combustibles->where('convenio', '1')->sum('monto');
            $suma_combustible_efectivo = $record->combustibles->where('convenio', '0')->sum('monto');
            $suma_gastos = $record->gastos()->sum('monto');
            $salario_operador = $record->monto_pagado;

            $suma_anticipos = $record->anticipos->sum('monto');
            $saldo_operador = $suma_anticipos - ($suma_casetas_efe + $suma_combustible_efectivo + $suma_gastos);

            $km_anterior = 0;

        @endphp
        <x-filament::section collapsible
                             icon="heroicon-o-user"
                             icon-color="info"
        >
            <x-slot name="heading" class="bg-blue-300">
                Gastos del viaje {{$record->id}} total {{$suma_gastos}}
            </x-slot>
               <livewire:gastos-combustible :viaje_id="$record->id" :key="$record->id"/>

                @foreach (App\Models\Viaje::GASTOS_OTROS as $key => $item)

                    <livewire:gastos-otros :viaje_id="$record->id" :tipo_gasto="$key" :key="$record->id"/>

                @endforeach
                    <livewire:gastos-caseta :viaje_id="$record->id" :key="$record->id"/>



        </x-filament::section>
    </x-filament::section>
</x-filament-panels::page>
