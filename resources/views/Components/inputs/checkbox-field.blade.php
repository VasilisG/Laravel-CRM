<div class="checkbox-field input-field">
  <label class="font-bold" for="{{ $id }}">{{ $label }}</label>
  <input 
    type="checkbox"
    name="{{ $name }}"
    @if(isset($value) and $value == '1')
      checked
    @endif
    {{ $attributes->merge(['class' => 'ms-2 w-4 h-4 text-sm font-medium text-gray-900 rounded']) }} />
</div>