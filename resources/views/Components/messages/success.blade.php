@if(session()->has('success'))
  <div class="text-white bg-green-500 p-2 my-4 rounded">
    {{ session()->get('success') }}
  </div>
@endif