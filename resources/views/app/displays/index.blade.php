<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Displays
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                        </x-table.row>
                    @endforeach  
                </x-table>
                {{ $displays->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
