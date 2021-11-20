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

        <x-table model-name="media">
            <x-slot name="heading">  
                <x-table.heading>ID</x-table.heading>
                <x-table.heading>Nome</x-table.heading>
                <x-table.heading>Descrição</x-table.heading>
                <x-table.heading>Tipo</x-table.heading>
                <x-table.heading colspan="3">Status</x-table.heading>
            </x-slot>
            @foreach ($medias as $media)
                <x-table.row :model="$media">
                    <x-table.cell>{{ $media->id }}</x-table.cell>
                    <x-table.cell>{{ $media->name }}</x-table.cell>
                    <x-table.cell>{{ $media->description }}</x-table.cell>
                    <x-table.cell>{{ ucfirst($media->type) }}</x-table.cell>
                    <x-table.cell>
                        @isset($media->path)
                            <x-badge class="w-32 bg-green-500">
                                Disponível
                            </x-badge>
                        @else
                            <x-badge class="w-32 bg-blue-500">
                                Em progresso
                            </x-badge>
                        @endisset
                    </x-table.cell>
                    <x-table.button action="edit" >                        
                        <x-slot name="text">
                            Editar
                        </x-slot>
                    </x-table.button>                            
                    <x-table.button action="delete">
                        <x-slot name="text">
                            Excluir
                        </x-slot>
                    </x-table.button>                            
                </x-table.row>
            @endforeach  
        </x-table>

        <div class="py-3 px-3">
            {{ $medias->links() }}
        </div>    

    </x-containers.main>
</x-app-layout>
