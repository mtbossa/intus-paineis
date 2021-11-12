@props(['action', 'modelId'])

@php
$text = ucfirst($action);

$action = strtolower($action);

switch ($action) {
    case 'excluir':
        $color       = 'bg-red-500';
        $color_hover = 'bg-red-600';
        break;
    default:
        $color       = 'bg-blue-500';
        $color_hover = 'bg-blue-700';
        break;
}

$class = "$color hover:$color_hover w-16 rounded text-center";
@endphp

<td>
    @if ($action === 'excluir')
        <button onClick="
            event.preventDefault();
            document.getElementById('delete-display-form-{{ $modelId }}').submit();
        " 
        type="button"
        class="{{ $class }}">
            Excluir
        </button>

        <form action="{{ route('displays.destroy', $modelId) }}" id="delete-display-form-{{ $modelId }}"
            method="POST" style="display:none;">
            @csrf
            @method('DELETE');
        </form>
    @else
        <a href="{{ $slot }}">
            <div class="{{ $class }}">
                {{ $text }}
            </div>
        </a>
    @endif
</td>
