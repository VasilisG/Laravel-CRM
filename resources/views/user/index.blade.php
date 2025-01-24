<x-layout title="Users">
  <x-messages.all></x-messages.all>
  <div class="search-container flex justify-between">
    <x-search-form action="" method="GET" placeholder="Search user..."></x-search-form>
    <x-action-link href="users/create" label="New" icon="add"></x-action-link>
  </div>
  <hr class="my-4">
  <x-table :columns='config("constants.USER_TABLE_COLUMNS")' :data="$users" resource="users"></x-table>
  <x-pagination :data="$users"></x-pagination>
</x-layout>