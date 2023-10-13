<div>
    @if($viajeGasto > 0)
        <x-filament::section collapsible>
            <x-slot name="heading" class="bg-blue-300">
                Combustibles {{ array_sum($viajeGasto) }}  Efectivo: {{ $viajeGasto[0] }}  Convenio: {{ $viajeGasto[1] }}
            </x-slot>
        <div class="mb-4">
            {{ $this->table }}
        </div>
        </x-filament::section>
    @endif
</div>
