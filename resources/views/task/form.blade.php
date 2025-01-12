<x-layout title="{{ $type === 'create' ? 'Create Task' : 'Update Task' }}">
<div class="task-form-container">
    <form 
      class="task-form entity-form" 
      action="{{ $type === 'create' ? URL::to('tasks') : URL::to('tasks/' . $task->id) }}" 
      method="POST"
      id="create-update-form"
    >
      @if($type === 'update')
        @method('PUT')
      @endif
      @csrf
      <div class="form-fields grid grid-cols-2 gap-x-6 gap-y-3">
        <x-inputs.text-field label="Title" id="title-field" name="title" required="true" value="{{ $task->title ?? '' }}"></x-inputs.text-field>
        <x-inputs.textarea-field label="Description" id="description-field" name="description" value="{{ $task->description ?? '' }}"></x-inputs.textarea-field>
        <x-inputs.text-field type="date" label="Deadline" id="deadline-field" name="deadline" required="true" value="{{ $task->deadline ?? '' }}"></x-inputs.text-field>
        <x-inputs.dropdown-field label="Status" id="status-field" name="status" :options="config('constants.TASK_STATUS')" value="{{ $task->status ?? '' }}"></x-inputs.dropdown-field>
        <x-inputs.dropdown-field label="Project" id="project-field" name="project" required="true" value="{{ $task->project->id ?? '' }}" :options="$projects"></x-inputs.dropdown-field>
        <x-inputs.text-field label="Cost" id="cost-field" name="cost" required="true" value="{{ $task->cost ?? '' }}"></x-inputs.text-field>
      </div>
    </form>
    <div class="form-actions mt-4 pt-4 border-t flex gap-2">
      <x-action-button form="create-update-form" class="rounded py-2 bg-sky-600 hover:bg-sky-700" label="{{ ucfirst($type) }}" icon="add"></x-action-button>
      @if($type === 'update')
        <form 
          class="task-form entity-form" 
          action="{{ URL::to('tasks/' . $task->id) }}" 
          method="POST"
          id="delete-form"
        >
          @method('DELETE')
          @csrf
          <x-action-button form="delete-form" class="rounded py-2 bg-red-700 hover:bg-red-800 important" label="Delete" title="Delete Task" icon="delete"></x-action-button>
        </form>
      @endif
    </div>
  </div>
  @if($errors->any())
    {!! implode('', $errors->all('<div class="text-white bg-red-700 p-2 mt-4 rounded">:message</div>')) !!}
  @endif
</x-layout>