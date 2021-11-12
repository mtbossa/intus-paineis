@props(['required' => 'false'])

<label
    {{ $attributes->merge([
            'class' => "text-gray-700",
        ]) 
    }}
>
    {{ $slot }}

    @if($required === 'true')
        <span class="text-red-500 required-dot">
            *
        </span>
    @endif
</label>