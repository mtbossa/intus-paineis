<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Display
        </h2>
    </x-slot>

    <x-containers.main>   
        <x-display.form action="{{ route('displays.store') }}" method="POST">
        </x-display.form>    
    </x-containers.main>
</x-app-layout>
