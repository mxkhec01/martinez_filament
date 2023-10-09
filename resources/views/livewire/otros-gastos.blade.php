<div>
    @if($viajeGasto > 0)
        <x-filament::section collapsible>
        <x-slot name="heading" class="bg-blue-300">
            {{ $tipoGasto }} {{$viajeGasto}}
        </x-slot>
{{--        <h2 class="text-2xl mb-4">{{ $tipoGasto }} {{ $viajeGasto }}</h2>--}}
        <div class="mb-4">
            {{ $this->table }}
        </div>
        </x-filament::section>
    @endif
</div>
