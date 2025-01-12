<div class="dropdown-field input-field">
  <label class="font-bold" for="{{ $id }}">{{ $label }}</label>
  <select 
    id="{{ $id }}" 
    name="{{ $name }}"
    autocomplete="off"
    {{ 
      $attributes
      ->merge(['class' => 'mt-2 bg-gray-50 border border-gray-300 outline-none text-gray-900 text-sm rounded-lg block w-full p-2'])
      ->filter(fn ($value, $key) => $key != 'options')
    }}
  >
    <option value="">-- Select an option --</option>

    <pre>{{ json_encode($options, JSON_PRETTY_PRINT) }}</pre>

    @if(isset($options))
      @foreach($options as $optionKey => $optionValue)
        <option 
          value="{{ $optionKey }}"
          @if(isset($value) && $optionKey == $value) selected
          @endif
        >
          {{ isset($optionValue['label']) ? $optionValue['label'] : $optionValue }}
        </option>
      @endforeach
    @endif
  </select>
</div>