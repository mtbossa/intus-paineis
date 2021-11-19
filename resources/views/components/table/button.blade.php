@props(['action', 'model', 'modelName'])

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
            document.getElementById('delete-{{ $modelName }}-form-{{ $model->id }}').submit();
        " 
        type="button"
        class="{{ $class }}">
            {{ $text }}
        </button>

        <form action="{{ route("{$modelName}s.destroy", $model->id) }}" id="delete-{{ $modelName }}-form-{{ $model->id }}"
            method="POST" style="display:none;">
            @csrf
            @method('DELETE');
        </form>
    @else
        <a href="{{ route("{$modelName}s.edit", $model->id) }}">
            <div class="{{ $class }}">
                {{ $text }}
            </div>
        </a>
    @endif
</td>
