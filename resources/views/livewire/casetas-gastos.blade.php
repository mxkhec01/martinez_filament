<div>
    @if($viajeGasto > 0)
        <x-filament::section collapsible>
            <x-slot name="heading" class="bg-blue-300">
                Casetas {{ \Filament\Support\format_money($viajeGasto,'MXN') }}
            </x-slot>
        <div class="mb-4">
            {{ $this->table }}
        </div>
        </x-filament::section>
    @endif
</div>
