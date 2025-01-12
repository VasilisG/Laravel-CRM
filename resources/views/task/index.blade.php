<x-layout title="Tasks">
  <x-messages.all></x-messages.all>
  <div class="search-container flex justify-between">
    <x-search-form action="" method="GET" placeholder="Search task..."></x-search-form>
    <x-action-link href="tasks/create" label="New" icon="add"></x-action-link>
  </div>
  <hr class="my-4">
  <x-table :columns='config("constants.TASK_TABLE_COLUMNS")' :data="$tasks" resource="tasks"></x-table>
  <x-pagination :data="$tasks"></x-pagination>
</x-layout>