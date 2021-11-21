<x-app-layout> 
    <x-slot name="header">      
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mídias
        </h2>

        @if(session('sucess'))
            <x-notification model-name="media">            
                {{ session('sucess') }}            
            </x-notification>
        @endif

    </x-slot>

    <x-containers.main>          
        <x-slot name="buttons">
            <x-containers.buttons>
                <x-anchor-button                  
                    href="{{ route('medias.create') }}"
                    button-type="new"  
                    icon="fas fa-plus"                    
                >                                                  
                    Novo 
                </x-anchor-button>                 
            </x-containers.buttons>
        </x-slot>

        <livewire:lists.media-list />

        <div class="py-3 px-3">
            {{ $medias->links() }}
        </div>    

    </x-containers.main>
</x-app-layout>
