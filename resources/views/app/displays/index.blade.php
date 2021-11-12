<x-app-layout> 
    <div class="py-12">        
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-1">
            <x-anchor-button
                class="mb-4 filter drop-shadow-md"
                href="{{ route('displays.create') }}"
            >
                Novo Display
            </x-jet-button> 
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table>
                    <x-slot name="heading">  
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading>Nome</x-table.heading>
                        <x-table.heading>Localização</x-table.heading>
                    </x-slot>
                    @foreach ($displays as $display)
                        <x-table.row>
                            <x-table.cell>{{ $display->id }}</x-table.cell>
                            <x-table.cell>{{ $display->name }}</x-table.cell>
                            <x-table.cell>{{ $display->location }}</x-table.cell>                            
                            <x-table.button action="editar" :test="request()->routeIs('displays.index')">{{ route('displays.edit', $display->id) }}</x-table.button>                            
                            <x-table.button action="excluir" model-id="{{ $display->id }}"></x-table.button>                            
                        </x-table.row>
                    @endforeach  
                </x-table>
                <div class="py-3 px-3">
                    {{ $displays->links() }}
                </div>
            </div>
        </div>
    </div>
    
            
</x-app-layout>
