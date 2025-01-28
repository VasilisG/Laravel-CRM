<div class="text-field input-field">
  <label class="font-bold" for="{{ $id }}">{{ $label }}</label>
  <input 
    type="{{ $type ?? 'text' }}"
    id="{{ $id }}" 
    name="{{ $name }}"
    value="{{ $value ?? '' }}"
    @if(isset($required) && $required === true)
      required
    @endif
    {{ $attributes->merge(['class' => 'mt-2 bg-gray-50 border border-gray-300 outline-none text-gray-900 text-sm rounded-lg block w-full p-2'])->filter(fn ($value, $key) => $key != 'required') }}
  />
  @error('{{ $id }}')
    <div class="text-red-500">Field is required.</div>
  @enderror
</div>
