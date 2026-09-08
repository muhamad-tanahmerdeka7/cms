@props([
    'name',
    'label' => null,
    'value' => '',
    'rows' => 3,
    'placeholder' => '',
    'required' => false,
    'help' => null,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <textarea name="{{ $name }}"
              id="{{ $name }}"
              rows="{{ $rows }}"
              placeholder="{{ $placeholder }}"
              {{ $required ? 'required' : '' }}
              {{ $attributes->merge(['class' => 'block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-150']) }}>{{ old($name, $value) }}</textarea>

    @if($help)
        <p class="mt-1 text-sm text-gray-500">{{ $help }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
