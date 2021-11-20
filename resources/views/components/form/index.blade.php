@props(['spoof' => null])

<form {{ $attributes->merge(['class' => "p-4 px-4 md:p-8"]) }}>
    @csrf
    @isset($spoof)
        @method($spoof)   
    @endisset
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1">     
        <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1">
                
                {{ $slot }}

                <button type="submit" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-min transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">Enviar</button>   
            </div>
        </div>
    </div>
</form>
