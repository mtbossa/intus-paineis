<x-app-layout> 
    <x-slot name="header">      
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Displays
        </h2>

        @if(session('sucess'))
            <x-notification model="display">            
                {{ session('sucess') }}            
            </x-notification>
        @endif

    </x-slot>

    <x-containers.main>  
        <x-slot name="buttons">
            <x-containers.buttons>
                <x-anchor-button                  
                    href="{{ route('displays.create') }}"
                    button-type="new"                      
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" viewBox="0 0 24 24" width="24px" height="24px" class="mr-2">
                    <path d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 11 L 7 11 L 7 13 L 11 13 L 11 17 L 13 17 L 13 13 L 17 13 L 17 11 L 13 11 L 13 7 L 11 7 z"/>
                </svg>                                       
                    Novo 
                </x-anchor-button>                 
            </x-containers.buttons>
        </x-slot>

        <x-table>
            <x-slot name="heading">  
                <x-table.heading>ID</x-table.heading>
                <x-table.heading>Nome</x-table.heading>
                <x-table.heading colspan="3">Localização</x-table.heading>
            </x-slot>
            @foreach ($displays as $display)
                <x-table.row>
                    <x-table.cell>{{ $display->id }}</x-table.cell>
                    <x-table.cell>{{ $display->name }}</x-table.cell>
                    <x-table.cell>{{ $display->location }}</x-table.cell>                            
                    <x-table.button action="edit" model-id="{{ $display->id }}">                        
                        <x-slot name="text">
                            Editar
                        </x-slot>
                    </x-table.button>                            
                    <x-table.button action="delete" model-id="{{ $display->id }}">
                        <x-slot name="text">
                            Excluir
                        </x-slot>
                    </x-table.button>                            
                </x-table.row>
            @endforeach  
        </x-table>

        <div class="py-3 px-3">
            {{ $displays->links() }}
        </div>    

    </x-containers.main>
</x-app-layout>
