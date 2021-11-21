@aware(['modelName', 'model'])
@props(['action' => null, 'color'])

@php
$action = $action ? strtolower($action) : null;

switch ($color) {
    case 'red':
        $colors = 'text-red-500 hover:text-red-700';
        break;
    default:
        $colors = 'text-blue-500 hover:text-blue-700';
        break;
}

$class = "$colors px-4";
@endphp

<td>
    @if ($action === 'delete')
        <button onClick="
            event.preventDefault();
            document.getElementById('delete-{{ $modelName }}-form-{{ $model->id }}').submit();
        " type="button" {{ $attributes->merge(['class' => $class]) }}>
            {{ $slot }}
        </button>

        <form action="{{ route("{$modelName}s.destroy", $model->id) }}"
            id="delete-{{ $modelName }}-form-{{ $model->id }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE');
        </form>
    @else
        <a {{ $attributes->merge(['class' => $class]) }}>
            {{ $slot }}
        </a>
    @endif
</td>
