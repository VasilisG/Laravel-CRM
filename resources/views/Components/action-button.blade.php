<button {{ $attributes->merge(['type' => 'submit', 'class' => 'action-button text-white px-4 flex items-center gap-2']) }}>
  @if(isset($icon))
    <span class="inline-block w-[25px]">@svg($icon)</span>
  @endif
  @if(isset($iconOnly))
    @if($iconOnly === false)
      <span>{{ $label ?? ''}}</span>
    @endif
  @else
    <span>{{ $label ?? ''}}</span>
  @endif
</button>