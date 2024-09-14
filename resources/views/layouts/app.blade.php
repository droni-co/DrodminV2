<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
  <div id="app">
    <v-app id="inspire">
      <v-navigation-drawer
        class="pt-4"
        color="grey-lighten-3"
        model-value
        rail>
        <v-avatar
          v-for="n in 12"
          :key="n"
          :color="`grey-${n === 1 ? 'darken' : 'lighten'}-1`"
          :size="n === 1 ? 36 : 20"
          class="d-block text-center mx-auto mb-9"
        ></v-avatar>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <v-btn
            block
            color="error"
            dark
            type="submit"
          >
            Logout
          </v-btn>
        </form>
      </v-navigation-drawer>

      <v-main>
        <main>
        {{ Auth::user()->name }}
          <hr>
          @yield('content')
        </main>
      </v-main>
    </v-app>
  </div>
</body>
</html>
