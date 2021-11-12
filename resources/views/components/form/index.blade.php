@props(['spoof' => null])

<form 
    {{ $attributes->merge([
        'class' => "p-4 px-4 md:p-8 mb-6"
    ]) }} 
>
    @csrf
    @isset($spoof)
        @method($spoof)   
    @endisset
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1">     
        <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1">
                
                {{ $slot }}

                <button type="submit">Enviar</button>   
            </div>
        </div>
    </div>
</div>
