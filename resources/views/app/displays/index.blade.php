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
                    icon="fas fa-plus"                    
                >                                                  
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
