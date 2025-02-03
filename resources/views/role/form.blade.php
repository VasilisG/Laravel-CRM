<x-layout title="{{ $type === 'create' ? 'Create Role' : 'Update Role' }}">
  <div class="role-form-container">
    <form 
      class="role-form entity-form" 
      action="{{ $type === 'create' ? URL::to('roles') : URL::to('roles/' . $role->id) }}" 
      method="POST"
      id="create-update-form"
    >
      @if($type === 'update')
        @method('PUT')
      @endif
      @csrf
      <div class="form-fields grid grid-cols-2 gap-x-6 gap-y-3">
        <x-inputs.text-field type="text" label="Role Name" name="role-name" id="role-field" required="true" value="{{ $role->name ?? '' }}"></x-inputs.text-field>
      </div>
      <div class="form-fields grid grid-cols-2 gap-x-6 gap-y-3 mt-6">
        <fieldset class="permission-fieldset">
          <legend class="font-bold">Permissions</legend>
          <div class="permissions-container grid grid-cols-2 gap-x-6 gap-y-3 border p-4 mt-2">
            <x-inputs.checkbox-field name="clients" id="clients" label="Clients" value="{{ $role->hasPermissionTo('clients') ?? '' }}"></x-inputs.checkbox-field>
            <x-inputs.checkbox-field name="projects" id="projects" label="Projects" value="{{ $role->hasPermissionTo('projects') ?? '' }}"></x-inputs.checkbox-field>
            <x-inputs.checkbox-field name="tasks" id="tasks" label="Tasks" value="{{ $role->hasPermissionTo('tasks') ?? '' }}"></x-inputs.checkbox-field>
            <x-inputs.checkbox-field name="users" id="users" label="Users" value="{{ $role->hasPermissionTo('users') ?? '' }}"></x-inputs.checkbox-field>
            <x-inputs.checkbox-field name="roles" id="roles" label="Roles" value="{{ $role->hasPermissionTo('roles') ?? '' }}"></x-inputs.checkbox-field>
          </div>
        </fieldset>
      </div>
      <div class="form-fields grid grid-cols-2 gap-x-6 gap-y-3 mt-6 pt-3 border-t">
        <x-inputs.text-field type="password" label="Current User Password" id="current-user-password-field" name="current-user-password" required="true"></x-inputs.text-field>
      </div>
    </form>
    <div class="form-actions mt-4 pt-4 border-t flex gap-2">
      <x-action-button form="create-update-form" class="rounded py-2 bg-sky-600 hover:bg-sky-700" label="{{ ucfirst($type) }}" icon="add"></x-action-button>
      @if($type === 'update')
        <form 
          class="role-form entity-form" 
          action="{{ URL::to('role/' . $role->id) }}" 
          method="POST"
          id="delete-form"
        >
          @method('DELETE')
          @csrf
          <x-action-button form="delete-form" class="rounded py-2 bg-red-700 hover:bg-red-800 important" label="Delete" title="Delete Role" icon="delete"></x-action-button>
        </form>
      @endif
    </div>
  </div>
  @if($errors->any())
    {!! implode('', $errors->all('<div class="text-white bg-red-700 p-2 mt-4 rounded">:message</div>')) !!}
  @endif
</x-layout>
