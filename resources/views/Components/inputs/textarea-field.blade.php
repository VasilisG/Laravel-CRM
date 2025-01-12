<div class="textarea-field input-field">
  <label class="font-bold" for="{{ $id }}">{{ $label }}</label>
  <textarea 
    id="{{ $id }}" 
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'mt-2 bg-gray-50 border border-gray-300 outline-none text-gray-900 text-sm rounded-lg block w-full p-2']) }}
  >{{ $value }}</textarea>
  @error('{{ $id }}')
    <div class="text-red-500">Field is required.</div>
  @enderror
</div>
