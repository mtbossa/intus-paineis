@props(['display' => null])

<div>    
    <x-slot name="buttons">
        <x-containers.buttons>
            <x-anchor-button                  
                href="{{ route('displays.index') }}"
                button-type="back"                      
            >           
            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" viewBox="0 0 24 24" width="24px" height="24px" class="mr-2">
                <path d="M 12 2 C 6.4889971 2 2 6.4889971 2 12 C 2 17.511003 6.4889971 22 12 22 C 17.511003 22 22 17.511003 22 12 C 22 6.4889971 17.511003 2 12 2 z M 12 4 C 16.430123 4 20 7.5698774 20 12 C 20 16.430123 16.430123 20 12 20 C 7.5698774 20 4 16.430123 4 12 C 4 7.5698774 7.5698774 4 12 4 z M 11 7 L 11 11 L 7 11 L 7 13 L 11 13 L 11 17 L 13 17 L 13 13 L 17 13 L 17 11 L 13 11 L 13 7 L 11 7 z"/>
            </svg>                           
                Voltar 
            </x-anchor-button>                 
        </x-containers.buttons>
    </x-slot>
    
    <x-form {{ $attributes->merge() }}>

        <x-form.field for="name">
            <x-slot name="label">
                <x-form.label for="name" required="true">           
                    Nome      
                </x-form.label>
            </x-slot>
            <x-form.input id="name" name="name" placeholder="Nome do display" type="text"
                value="{{ old('name', optional($display ?? null)->name) }}" />
        </x-form.field>
    
        <x-form.field for="location">
            <x-slot name="label">
                <x-form.label for="location" required="true">
                    Localização
                </x-form.label>
            </x-slot>
            <x-form.input id="location" name="location" placeholder="Endereço" type="text"
                value="{{ old('location', optional($display ?? null)->location) }}" />
        </x-form.field>
    
    </x-form>  
</div>