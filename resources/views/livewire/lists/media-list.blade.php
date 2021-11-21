<div>
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
                        <x-badge color="green">
                            Disponível
                        </x-badge>
                    @else
                        <x-badge color="blue">
                            Em progresso
                        </x-badge>
                    @endisset
                </x-table.cell>
                <x-table.button href="{{ route('medias.edit', $media->id) }}" color="blue">                                          
                    Editar                 
                </x-table.button>        
                <x-table.button wire:click.prevent="showDeleteModal({{ $media->id }})" color="red" href="">              
                    Excluir              
                </x-table.button>                            
            </x-table.row>
        @endforeach  
    </x-table>

    <x-jet-confirmation-modal wire:model="showDeleteModal">
        <x-slot name="title">Excluir mídia</x-slot>
        <x-slot name="content">Todos os posts que possuem essa mídia serão excluídos também. Deseja continuar?</x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showDeleteModal')">
            Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click.prevent="deleteMedia">
                Excluir
            </x-jet-danger-button>
        </x-slot>     
    </x-jet-confirmation-modal>
</div>
