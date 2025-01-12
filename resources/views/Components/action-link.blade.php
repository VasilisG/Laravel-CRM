<a {{ $attributes->merge(['class' => 'bg-sky-600 hover:bg-sky-700 text-white px-4 rounded-lg flex items-center gap-1']) }}>
  @if(isset($icon))
    <span class="inline-block w-[30px]">@svg($icon)</span>
  @endif
  @if(isset($iconOnly))
    @if($iconOnly === false)
      <span>{{ $label ?? ''}}</span>
    @endif
  @else
    <span>{{ $label ?? ''}}</span>
  @endif
</a>