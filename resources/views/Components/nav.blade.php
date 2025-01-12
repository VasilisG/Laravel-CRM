<div {{ $attributes->merge(['class' => 'nav-container']) }}>
  <div class="nav-container-inner h-full">
    <p class="app-name text-center p-4 bg-gray-700 font-bold">{{ strtoupper(config("app.name"))}}</p>
    <nav class="py-4">
      <ul class="nav-list">
        @foreach(config("constants.NAV_LINKS") as $nav_link => $nav_data)
          <li class="nav-list-item">
            @php
              $currentRouteName = Route::current()->getName();
              $topRoute = explode('.', $currentRouteName)[0];
            @endphp
            @if($topRoute === $nav_link)
              <x-nav-link class="text-white bg-gray-800 font-bold block p-3 hover:bg-gray-900 duration-200 flex items-center gap-2"  href="/{{$nav_link}}">
                <span class="inline-block w-[20px]">@svg($nav_data['icon'])</span>
                <span>{{ $nav_data['label'] }}</span>
              </x-nav-link>
            @else
              <x-nav-link class="text-gray-300 hover:text-gray-200 hover:font-bold block p-3 hover:bg-gray-700 duration-200 flex items-center gap-2"  href="/{{$nav_link}}">
              <span class="inline-block w-[20px]">@svg($nav_data['icon'])</span>
              <span>{{ $nav_data['label'] }}</span>
              </x-nav-link>
            @endif
          </li>
        @endforeach
      </ul>
    </nav>
  </div>
</div>