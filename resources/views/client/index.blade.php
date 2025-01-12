<x-layout title="Clients">
  <x-messages.all></x-messages.all>
  <div class="search-container flex justify-between">
    <x-search-form action="" method="GET" placeholder="Search client..."></x-search-form>
    <x-action-link href="clients/create" label="New" icon="add"></x-action-link>
  </div>
  <hr class="my-4">
  <x-table :columns='config("constants.CLIENT_TABLE_COLUMNS")' :data="$clients" resource="clients"></x-table>
  <x-pagination :data="$clients"></x-pagination>
</x-layout>