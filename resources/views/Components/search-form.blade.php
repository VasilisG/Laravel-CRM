<form class="flex justify-between" {{ $attributes->merge(['class' => 'search-form', 'action' => '', 'method' => 'POST']) }}>
  <input 
    class="search-input bg-gray-50 border border-gray-300 outline-none text-gray-900 text-sm rounded-l-lg block w-full p-2 min-w-[400px]" 
    required 
    name="search" 
    type="text" 
    placeholder="{{ $placeholder ?? '' }}"
  />
  <x-action-button 
    class="rounded-r-lg bg-sky-600 hover:bg-sky-700" 
    label="Search" 
    icon="search"
    :iconOnly="true"
  ></x-action-button>
</form>