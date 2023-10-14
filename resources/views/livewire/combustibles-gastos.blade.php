<div>
    @if($viajeGasto > 0)
        <x-filament::section collapsible>
            <x-slot name="heading" class="bg-blue-300">
                Combustibles {{ \Filament\Support\format_money(array_sum($viajeGasto),'MXN') }}
            </x-slot>
            <x-slot name="description">
                Efectivo: {{ isset($viajeGasto[0]) ? \Filament\Support\format_money($viajeGasto[0],'MXN') : 0 }}  Convenio: {{ isset($viajeGasto[1]) ? \Filament\Support\format_money($viajeGasto[1],'MXN') : 0 }}
            </x-slot>
        <div class="mb-4">
            {{ $this->table }}
        </div>
        </x-filament::section>
    @endif
</div>
