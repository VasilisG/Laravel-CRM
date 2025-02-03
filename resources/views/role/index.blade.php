<x-layout title="Roles">
  <x-messages.all></x-messages.all>
  <div class="search-container flex justify-between">
    <x-search-form action="" method="GET" placeholder="Search role..."></x-search-form>
    <x-action-link href="roles/create" label="New" icon="add"></x-action-link>
  </div>
  <hr class="my-4">
  <x-table :columns='config("constants.ROLE_TABLE_COLUMNS")' :data="$roles" resource="roles"></x-table>
  <x-pagination :data="$roles"></x-pagination>
</x-layout>