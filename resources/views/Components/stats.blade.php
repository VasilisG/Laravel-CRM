@if(isset($data) && !empty($data))
<div {{ $attributes->merge(['class' => 'client-stats rounded border border-gray-300 p-4 min-w-[300px]'])->filter(fn ($value, $key) => $key != 'data') }}>
  <div class="stats-title-container flex justify-between items-center border-b">
    <h2 class="stats-title text-4xl font-semibold pb-2">{{ $title }}</h2>
    <a class="inline-flex items-center font-bold text-sky-600 hover:text-sky-800" href="{{ URL::to($resource) }}">
      <span class="inline-block relative bottom-[2px]">More</span>
      <span class="inline-block w-[25px]">@svg("arrow-right")</span>
    </a>
  </div>
  <div class="stats-data mt-3 text-xl">
    <div class="total flex gap-2 py-1">
      <span class="min-w-[100px] flex-1">{{ $data['total']['label'] }}</span>
      <span class="font-semibold flex-1 text-right {{ $data['total']['style'] }}">{{ $data['total']['value'] }}</span>
    </div>
    @foreach($data['items'] as $item)
      <div class="flex gap-2 py-1">
        <span class="min-w-[100px] flex-1">{{ $item['label'] }}</span>
        <span class="font-semibold flex-1 text-right {{ $item['style'] }}">{{ $item['value'] }}</span>
      </div>
    @endforeach
  </div>
</div>
@endif