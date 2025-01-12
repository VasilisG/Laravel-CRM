<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head title="{{$title ?? ''}}"></x-head>
    <body class="min-h-screen">
        <div class="app-container flex  min-h-screen">
          <x-nav class="w-[300px] bg-gray-600 text-white"></x-nav>
          <x-main class="flex-1 py-4 px-6 bg-gray-150" title="{{$title ?? ''}}"> {{ $slot }} </x-main>
        </div>
    </body>
</html>