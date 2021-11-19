<x-app-layout>  
    <x-slot name="header">      
        <h2 class="py-2 font-semibold text-xl text-gray-800 leading-tight">
            Mídia {{ $media->id }} - {{ $media->name }} 
        </h2>
    </x-slot>

    <x-containers.main>
        @if(session('sucess'))
            <x-notification model="media" class="mt-5">        
                {{ session('sucess') }}            
            </x-notification>
        @endif

        <x-media.form action="{{ route('medias.update', ['media' => $media->id]) }}" method="POST" spoof="PATCH" :media="$media">
        </x-media.form>
    </x-containers.main>
</x-app-layout>
