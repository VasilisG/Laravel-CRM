<div class="radio-field input-field">
  <input 
    type="radio" 
    id="{{ $id }}" 
    name="{{ $name }}" 
    value="{{ $value }}" 
    @checked(isset($checked) && $checked == true)
    @required(isset($required) && $required == true)
  />
  <label for="{{ $id }}">{{ $value }}</label>
</div>