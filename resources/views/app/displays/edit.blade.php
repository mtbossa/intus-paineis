<x-app-layout>
    <x-main-container>
        <x-display.form action="{{ route('displays.update', ['display' => $display->id]) }}" method="POST" spoof="PATCH" :display="$display">
        </x-display.form>
    </x-main-container>
</x-app-layout>
