@props([
'id',
'name',
'label' => null,
'type' => 'text',
'value' => '',
'placeholder' => '',
'required' => false,
])
{{-- => defaults --}}
<div class="mb-4">

  @if($label)
  <label class="block text-gray-700" for="{{ $id }}">{{ $label }}</label>
  @endif

  <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}" {{-- The second parameter is a default value to use if no
    old input exists --}} value="{{ old($name, $value) }}"
    class="w-full px-4 py-2 border rounded focus:outline-none @error($name) border-red-500 @enderror"
    placeholder="{{ $placeholder }}" {{$required ? 'required' : '' }} />
  @error($name)
  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>