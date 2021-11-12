@props(['for'])

<div class="relative mb-6">
    {{ $label }}

    {{ $slot }}  

    @error($for)
        <x-form.error>
            {{ $message }}
        </x-form.error>
    @enderror
</div>