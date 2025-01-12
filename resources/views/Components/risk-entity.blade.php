<div class="dash-list-container p-4 border border-gray-300 rounded-lg inline-block">
  <div class="dash-list-title-container border-b">
    <h2 class="dash-list-title text-4xl font-semibold pb-2">{{ $title }}</h2>
  </div>
  <div class="dash-list-container">
    <ul class="dash-list">
      @foreach($data as $elem)
        <li class="dash-list-item flex gap-4 mt-3 [&:not(:last-child)]:pb-3 [&:not(:last-child)]:border-b">
          <span class="text-blue-600 hover:text-blue-900 min-w-[500px] font-semibold flex items-center">
            <a class="w-full" href="{{ URL::to($resource) }}/{{ $elem->id }}/edit">{{ $elem->title }}</a>
          </span>
          <span class="flex items-center gap-6 h-[32px]">
            <span class="dash-list-item-deadline font-semibold px-4 border-x border-gray-400">{{ $elem->deadline }}</span>
            @if($elem->deadline < now()->toDateTimeString())
              <span class="bg-red-200 text-red-800 font-bold px-2 py-1 rounded-lg">Overdue</span>
            @elseif($elem->deadline == now()->toDateTimeString())
              <span class="bg-amber-200 text-amber-700 font-bold px-2 py-1 rounded-lg">Deadline ends today</span>
            @else
              <span class="bg-lime-200 text-lime-700 font-bold px-2 py-1 rounded-lg">Approaching deadline</span>
            @endif
          </span>
        </li>
      @endforeach
    </ul>
  </div>
</div>