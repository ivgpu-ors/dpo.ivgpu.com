<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title . ' - '. config('app.name') ?? config('app.name') }}</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="index-page h-screen pt-12">

<x-top-bar />

<main id="app">
  {{ $slot }}
</main>

<x-footer />

</body>
</html>
