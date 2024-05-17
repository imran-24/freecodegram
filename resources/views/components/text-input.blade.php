@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'ring-gray-200   focus:border-0 focus:ring-2  focus:ring-sky-500 rounded-md border-0 outline-0   ring-2']) !!}>
