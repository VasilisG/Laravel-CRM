<form {{ $attributes->merge(['class' => 'logout-form']) }} method="POST" action="{{ route('logout') }}">
  @csrf
  @method('POST')
  <x-action-button 
    class="mt-3 !text-gray-300 hover:text-gray-200 hover:font-bold block !p-3 hover:bg-gray-700 duration-200 flex items-center gap-2 w-full"
    label="Logout" 
    icon="logout"
  >
  </x-action-button>
</form>