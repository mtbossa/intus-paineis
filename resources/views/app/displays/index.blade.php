<x-app-layout> 
    <x-slot name="header">      
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Displays
        </h2>

        @if(session('sucess'))
            <x-notification model-name="display">            
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

        <x-table model-name="display" >
            <x-slot name="heading">  
                <x-table.heading>ID</x-table.heading>
                <x-table.heading>Nome</x-table.heading>
                <x-table.heading colspan="3">Localização</x-table.heading>
            </x-slot>
            @foreach ($displays as $display)
                <x-table.row :model="$display">
                    <x-table.cell>{{ $display->id }}</x-table.cell>
                    <x-table.cell>{{ $display->name }}</x-table.cell>
                    <x-table.cell>{{ $display->location }}</x-table.cell>                            
                    <x-table.button href="{{ route('displays.edit', $display->id) }} " color="blue">                                          
                        Editar                   
                    </x-table.button>                            
                    <x-table.button action="delete" color="red">                       
                        Excluir                       
                    </x-table.button>                           
                </x-table.row>
            @endforeach  
        </x-table>

        <div class="py-3 px-3">
            {{ $displays->links() }}
        </div> 
    </x-containers.main>
</x-app-layout>
