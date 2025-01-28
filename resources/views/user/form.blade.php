<x-layout title="{{ $type === 'create' ? 'Create User' : 'Update User' }}">
  <div class="user-form-container">
    <form 
      class="user-form entity-form" 
      action="{{ $type === 'create' ? URL::to('users') : URL::to('users/' . $user->id) }}" 
      method="POST"
      id="create-update-form"
    >
      @if($type === 'update')
        @method('PUT')
      @endif
      @csrf
      <div class="form-fields grid grid-cols-2 gap-x-6 gap-y-3">
        <x-inputs.text-field label="Name" id="name-field" name="name" required="true" value="{{ $user->name ?? '' }}"></x-inputs.text-field>
        <x-inputs.text-field type="email" label="Email" id="email-field" name="email" required="true" value="{{ $user->email ?? '' }}"></x-inputs.text-field>
        <x-inputs.text-field type="password" label="Password" id="password-field" name="password" required="{{ $type === 'create' }}"></x-inputs.text-field>
        <x-inputs.text-field type="password" label="Confirm Password" id="confirm-password-field" name="password_confirmation" required="{{ $type === 'create' }}"></x-inputs.text-field>
      </div>
      @if($type === 'create' || Auth::id() !== $user->id)
        <div class="form-fields grid grid-cols-2 gap-x-6 gap-y-3 mt-6 pt-3 border-t">
          <x-inputs.text-field type="password" label="Current User Password" id="current-user-password-field" name="current-user-password" required="true"></x-inputs.text-field>
        </div>
      @endif
    </form>
    <div class="form-actions mt-4 pt-4 border-t flex gap-2">
      <x-action-button form="create-update-form" class="rounded py-2 bg-sky-600 hover:bg-sky-700" label="{{ ucfirst($type) }}" icon="add"></x-action-button>
      @if($type === 'update')
        <form 
          class="user-form entity-form" 
          action="{{ URL::to('users/' . $user->id) }}" 
          method="POST"
          id="delete-form"
        >
          @method('DELETE')
          @csrf
          <x-action-button form="delete-form" class="rounded py-2 bg-red-700 hover:bg-red-800 important" label="Delete" title="Delete User" icon="delete"></x-action-button>
        </form>
      @endif
    </div>
  </div>
  @if($errors->any())
    {!! implode('', $errors->all('<div class="text-white bg-red-700 p-2 mt-4 rounded">:message</div>')) !!}
  @endif
</x-layout>
