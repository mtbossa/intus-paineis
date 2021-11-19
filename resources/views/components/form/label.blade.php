@props(['required' => 'false', 'tooltip' => null])

<div class="relative inline-flex items-center justify-between space-x-2 max-w-sm">
    <label {{ $attributes->merge([
        'class' => 'text-gray-700',
    ]) }}>
        {{ $slot }}

        @if ($required === 'true')
            <span class="text-red-500">
                *
            </span>
        @endif
    </label>
    @isset($tooltip)
        <div class="inline group">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                    class="h-4 w-4 group-hover:text-blue-500 transition duration-150">
                    <path d="M12 11.5V16.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 7.51L12.01 7.49889" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>

            <div class="invisible group-hover:visible absolute top-0 left-0 z-10 space-y-1 bg-gray-900 text-gray-50 text-sm rounded px-4 py-2 w-full max-w-xs shadow-md"
                role="tooltip" aria-hidden="true">
                <p>A real strong password must contain:</p>

                <ul class="list-disc pl-4">
                    <li>a haiku</li>
                    <li>a gang sign</li>
                    <li>a DNA sample</li>
                </ul>
            </div>
        </div>
    @endisset
</div>
