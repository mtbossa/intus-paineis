@props(['display' => null])

<div>    
    <x-slot name="buttons">
        <x-containers.buttons>
            <x-anchor-button                  
                href="{{ route('displays.index') }}"
                button-type="back"   
                icon="fas fa-arrow-left"                   
            >                      
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