@props(['action', 'modelId'])

@php
$action = strtolower($action);

switch ($action) {
    case 'delete':
        $colors = 'text-red-500 hover:text-red-700';
        break;
    default:
        $colors = 'text-blue-500 hover:text-blue-700';
        break;
}

$class = "$colors text-center px-2";
@endphp

<td>
    @if ($action === 'delete')
        <button onClick="
            event.preventDefault();
            document.getElementById('delete-display-form-{{ $modelId }}').submit();
        " 
        type="button"
        class="{{ $class }}">
            {{ $text }}
        </button>

        <form action="{{ route('displays.destroy', $modelId) }}" id="delete-display-form-{{ $modelId }}"
            method="POST" style="display:none;">
            @csrf
            @method('DELETE');
        </form>
    @else
        <a href="{{ route('displays.edit', $modelId) }}">
            <div class="{{ $class }}">
                {{ $text }}
            </div>
        </a>
    @endif
</td>
