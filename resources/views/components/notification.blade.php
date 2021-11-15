@props(['model' => ''])

@php    
    switch(session('sucess')):
        case __("messages.{$model}_created"):
            $colors = 'bg-green-800';
            break;
        case __("messages.{$model}_deleted"):
            $colors = 'bg-red-800';
            break;
        case __("messages.{$model}_updated"):
            $colors = 'bg-blue-800';
            break;
        default:
            $colors = 'bg-grey-800';
            break;
    endswitch;

    $class = "$colors p-2 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex";
@endphp

<div {{ $attributes->merge(['class' => 'text-center mx-auto lg:px-4']) }}>
    <div class="{{ $class }}" role="alert">                   
        <span class="font-semibold text-left flex-auto">{{ $slot }}</span>                    
    </div>
</div>