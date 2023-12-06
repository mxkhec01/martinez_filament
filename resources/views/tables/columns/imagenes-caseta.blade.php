<div class="flex -space-x-2">
    @if(file_exists(asset('storage' . $getRecord()->foto_url))&& filesize(asset('storage' . $getRecord()->foto_url) >0 ))
    <a href="{{ asset('storage' . $getRecord()->foto_url) }}" target="_blank"><img
            src="{{ asset('storage' . $getRecord()->foto_url) }}"
            style="height: 2rem; width: 2rem;"
            class="max-w-none object-cover object-center rounded-full ring-white dark:ring-gray-900 ring-2">
    </a>
    @else
        <img src="{{ asset('storage' . 'default.jpg') }}" style="height: 2rem; width: 2rem;" class="max-w-none object-cover object-center rounded-full ring-white dark:ring-gray-900 ring-2">

    @endif
</div>
