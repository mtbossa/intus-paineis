<x-app-layout>  
    <x-slot name="header">      
        <h2 class="py-2 font-semibold text-xl text-gray-800 leading-tight">
            Display {{ $display->id }} - {{ $display->name }} 
        </h2>
    </x-slot>

    <x-containers.main>
        @if(session('sucess'))
            <x-notification model="display" class="mt-5">        
                {{ session('sucess') }}            
            </x-notification>
        @endif

        <x-display.form action="{{ route('displays.update', ['display' => $display->id]) }}" method="POST" spoof="PATCH" :display="$display">
        </x-display.form>
    </x-containers.main>
</x-app-layout>
