<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <icon src="https://i.imgur.com/mcvQfNt.jpeg"></icon>

        <title></title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <script src="https://cdn.tailwindcss.com">
        </script>
    </head>



  <body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        {{-- <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" /> --}}
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Log in</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        {{$slot}}
    </div>
    </div>
  </body>
</html>