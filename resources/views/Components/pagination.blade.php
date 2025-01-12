@if(!$data->isEmpty())
  <div class="pagination-container mt-3">
    {{ $data->appends(request()->except('page'))->links() }}
  </div>
@endif