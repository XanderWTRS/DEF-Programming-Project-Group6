@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-red-300 focus:border-red-100 focus:ring-red-100 rounded-md shadow-sm']) !!}>
