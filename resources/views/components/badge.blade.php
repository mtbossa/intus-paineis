@php
    $size = ($attributes->get('size') === 'large')
                ?  ' text-sm font-medium mr-2 px-2.5 py-0.5 rounded-md '
                :  ' text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md ';
    
    switch ($attributes->get('color')) {
        case 'dark':
            $color = ' bg-gray-100 text-gray-800 ';
            break;
        case 'red':
            $color = ' bg-red-100 text-red-800 ';
            break;
        case 'green':
            $color = ' bg-green-100 text-green-800 ';
            break;
        case 'yellow':
            $color = ' bg-yellow-100 text-yellow-800 ';
            break;
        case 'indigo':
            $color = ' bg-indigo-100 text-indigo-800 ';
            break;
        case 'purple':
            $color = ' bg-purple-100 text-purple-800 ';
            break;
        case 'pink':
            $color = ' bg-pink-100 text-pink-800 ';
            break;        
        default:
            $color = ' bg-blue-100 text-blue-800 ';
            break;
    }

    $class = "$color $size";

@endphp

<span {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</span>
