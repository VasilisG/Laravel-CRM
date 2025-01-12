<x-layout title="Projects">
  <x-messages.all></x-messages.all>
  <div class="search-container flex justify-between">
      <x-search-form action="" method="GET" placeholder="Search project..."></x-search-form>
      <x-action-link href="projects/create" label="New" icon="add"></x-action-link>
  </div>
  <hr class="my-4">
  <x-table :columns='config("constants.PROJECT_TABLE_COLUMNS")' :data="$projects" resource="projects"></x-table>
  <x-pagination :data="$projects"></x-pagination>
</x-layout>