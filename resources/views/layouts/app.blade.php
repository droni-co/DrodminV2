<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
  <div id="app" class="d-flex flex-column" style="min-height: 100vh;">
    <header>
      @include('layouts._header', ['site' => $site ?? null])
    </header>
    @include('layouts._alerts')
    <main class="flex-grow-1">
      @yield('content')
    </main>
    <footer>
      @include('layouts._footer')
    </footer>
  </div>
</body>
</html>
