<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <x-meta-social :title="$title ?? config('app.name')"
                  :description="$description"
                  :image="$image ?? null" />
  <x-meta-icons />
  {{ $meta ?? '' }}

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="index-page h-screen pt-12 flex flex-col">

<x-top-bar />

<main id="app" class="flex-grow">
  {{ $slot }}
</main>

<x-footer />

</body>
</html>
