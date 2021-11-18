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
    
    <x-form wire:submit.prevent="storeMedia">

        <x-form.field for="name">
            <x-slot name="label">
                <x-form.label for="name" required="true">           
                    Nome      
                </x-form.label>
            </x-slot>
            <x-form.input id="name" name="name" placeholder="Nome da mídia" type="text"
                value="{{ old('name') }}" wire:model="name"/>
        </x-form.field>
    
        <x-form.field for="description">
            <x-slot name="label">
                <x-form.label for="description" required="true">
                    Descrição
                </x-form.label>
            </x-slot>
            <x-form.input id="description" name="description" placeholder="Descrição da mídia" type="text"
                value="{{ old('description') }}" wire:model="description"/>
        </x-form.field>

        <x-form.field for="media">
            <x-slot name="label">
                <x-form.label for="media" required="true">
                    Arquivo (mídia)
                </x-form.label>
            </x-slot>
            <x-form.filepond 
                wire:model="media"
                allowImagePreview
                imagePreviewMaxHeight="200"
                allowFileTypeValidation
                acceptedFileTypes="['image/jpg', 'image/jpeg', 'image/png', 'video/mp4']"
                allowFileSizeValidation
                maxFileSize="100mb"
            />
        </x-form.field>
    
    </x-form>  
</div>

