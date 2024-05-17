@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-neutral-500']) }}>
    {{ $value ?? $slot }}
</label>
