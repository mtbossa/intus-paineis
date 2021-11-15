@props(['buttonType' => '', 'icon' => ''])

@php
    switch($buttonType): 
        case('new'):
            $colors = 'bg-green-600 hover:bg-green-700 focus:ring-green-500 focus:ring-offset-green-200';            
            break;  
        case('back'):
            $colors = 'bg-blue-600 hover:bg-blue-700 focus:ring-green-500 focus:ring-offset-green-200';            
            break;     
        default:
            $colors = '';
            break;
    endswitch;

    $class = "$colors w-min inline-block flex justify-center items-center px-4 py-2 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ";
@endphp

<a {{ $attributes->merge(['class' => $class]) }}> 
    <i class="{{ $icon }} mr-2"></i>
    {{ $slot }}      
</a>