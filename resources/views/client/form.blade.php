<x-layout title="{{ $type === 'create' ? 'Create Client' : 'Update Client' }}">
  <div class="client-form-container">
    <form 
      class="client-form entity-form" 
      action="{{ $type === 'create' ? URL::to('clients') : URL::to('clients/' . $client->id) }}" 
      method="POST"
      id="create-update-form"
    >
      @if($type === 'update')
        @method('PUT')
      @endif
      @csrf
      <div class="form-fields grid grid-cols-2 gap-x-6 gap-y-3">
        <x-inputs.text-field label="Company" id="company-field" name="company" required="true" value="{{ $client->company ?? '' }}"></x-inputs.text-field>
        <x-inputs.text-field label="VAT" id="vat-field" name="vat" required="true" value="{{ $client->vat ?? '' }}"></x-inputs.text-field>
        <x-inputs.text-field type="email" label="Email" id="email-field" name="email" required="true" value="{{ $client->email ?? '' }}"></x-inputs.text-field>
        <x-inputs.text-field label="Phone" id="phone-field" name="phone" required="true" value="{{ $client->phone ?? '' }}"></x-inputs.text-field>
        <x-inputs.text-field label="Address" id="address-field" name="address" value="{{ $client->address ?? '' }}"></x-inputs.text-field>
        <x-inputs.checkbox-field label="Active" id="active-field" name="active" value="{{ $client->active ?? 'off' }}"></x-inputs.checkbox-field>
      </div>
    </form>
    <div class="form-actions mt-4 pt-4 border-t flex gap-2">
      <x-action-button form="create-update-form" class="rounded py-2 bg-sky-600 hover:bg-sky-700" label="{{ ucfirst($type) }}" icon="add"></x-action-button>
      @if($type === 'update')
        <form 
          class="client-form entity-form" 
          action="{{ URL::to('clients/' . $client->id) }}" 
          method="POST"
          id="delete-form"
        >
          @method('DELETE')
          @csrf
          <x-action-button form="delete-form" class="rounded py-2 bg-red-700 hover:bg-red-800 important" label="Delete" title="Delete Client" icon="delete"></x-action-button>
        </form>
      @endif
    </div>
  </div>
  @if($errors->any())
    {!! implode('', $errors->all('<div class="text-white bg-red-700 p-2 mt-4 rounded">:message</div>')) !!}
  @endif
</x-layout>
