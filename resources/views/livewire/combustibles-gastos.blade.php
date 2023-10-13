<div>
    @if($viajeGasto > 0)
        <x-filament::section collapsible>
            <x-slot name="heading" class="bg-blue-300">
                Combustibles {{ array_sum($viajeGasto) }}  Efectivo: {{ isset($viajeGasto[0]) ? $viajeGasto[0] : 0 }}  Convenio: {{ isset($viajeGasto[1]) ? $viajeGasto[1] : 0 }}
            </x-slot>
        <div class="mb-4">
            {{ $this->table }}
        </div>
        </x-filament::section>
    @endif
</div>
