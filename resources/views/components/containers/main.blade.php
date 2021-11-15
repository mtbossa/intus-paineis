<div class="pb-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-1">
        @isset($buttons)
            {{ $buttons }}
        @endisset
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>  