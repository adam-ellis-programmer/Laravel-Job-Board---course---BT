@props(['id', 'name', 'label' => null, 'options' => [], 'value' => []])

<div class="mb-4">
    @if($label)
    <label class="block text-gray-700" for="{{ $id }}">{{ $label }}</label>
    @endif
    <select id="{{ $id }}" name="{{ $name }}"
    class="w-full px-4 py-2 border rounded focus:outline-none @error($name) border-red-500 @enderror">
    
    @foreach($options as $optionValue => $optionLabel)
    {{-- ensures that when the form reloads with validation errors, the dropdown remains set to the user's previous selection instead of resetting to the default option --}}
    <option value="{{ $optionValue }}" {{ old($name, $value)==$optionValue ? 'selected' : '' }}>
      {{ $optionLabel }}
    </option>
    @endforeach
  
</select>
  @error($name)
  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>