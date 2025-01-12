<div {{ $attributes->merge(['class' => 'main-container']) }}>
  <x-main-title class="text-4xl font-extrabold" title="{{$title}}"></x-main-title>
  <hr class="my-4">
  {{ $slot }}
</div>