@props(['field'])

@error($field)
  <span {{ $attributes->merge(['class' => 'field-error', 'style' => 'display:block;margin-top:4px;font-size:12px;font-family:Inter,system-ui,sans-serif;color:#b91c1c;']) }}>{{ $message }}</span>
@enderror
