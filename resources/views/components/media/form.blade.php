@props(['media' => null])

<div>    
    <x-slot name="buttons">
        <x-containers.buttons>
            <x-anchor-button                  
                href="{{ route('medias.index') }}"
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
            <x-form.input id="name" name="name" placeholder="Nome da mídia" type="text"
                value="{{ old('name', optional($media ?? null)->name) }}"/>
        </x-form.field>
    
        <x-form.field for="description">
            <x-slot name="label">
                <x-form.label for="description" required="true">
                    Descrição
                </x-form.label>
            </x-slot>
            <x-form.input id="description" name="description" placeholder="Descrição da mídia" type="text"
                value="{{ old('description', optional($media ?? null)->description) }}"/>
        </x-form.field>
    
    </x-form>  
</div>