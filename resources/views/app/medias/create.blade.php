<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nova mídia
        </h2>
    </x-slot>

    <x-containers.main>   
        {{-- <x-media.form action="{{ route('medias.store') }}" method="POST" enctype="multipart/form-data">
        </x-media.form>     --}}
        <livewire:forms.media-create />
    </x-containers.main>
</x-app-layout>
