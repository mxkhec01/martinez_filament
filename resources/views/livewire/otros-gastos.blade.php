<div>

    @if($viajeGasto > 0)
        <h2 class="text-2xl mb-4">{{ $tipoGasto }} {{ $viajeGasto }}</h2>
        <div class="mb-4">
            {{ $this->table }}
        </div>
    @endif
</div>
