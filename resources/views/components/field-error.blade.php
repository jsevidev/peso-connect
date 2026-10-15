@props(['field'])

@error($field)
  <span {{ $attributes->merge(['class' => 'field-error', 'role' => 'alert']) }}>{{ $message }}</span>
@enderror
