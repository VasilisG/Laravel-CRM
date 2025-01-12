@if(session()->has('error'))
  <div class="text-white bg-red-700 p-2 my-4 rounded">
    {{ session()->get('error') }}
  </div>
@endif
@if($errors->any())
  {!! implode('', $errors->all('<div class="text-white bg-red-700 p-2 mt-4 rounded">:message</div>')) !!}
@endif