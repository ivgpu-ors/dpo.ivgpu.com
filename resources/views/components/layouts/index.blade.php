<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <x-meta-social :title="$title ?? config('app.name')"
                 description="Платформа услуг дополнительного образования, предлагаемых ИВГПУ."
                 :image="asset('images/index-cover.jpg')" />
  <x-meta-icons />
  {{ $meta ?? '' }}

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="index-page h-screen pt-12">

<x-top-bar />

<header class="header">
  <div class="container h-full flex flex-col lg:flex-row items-center text-light p-4">
    <h1 class="text-2xl text-center lg:text-left lg:text-6xl uppercase relative lg:mb-0">Навигатор <br> дополнительного <br> образования</h1>
    <div class="relative lg:text-xl lg:ml-32">
      <p>
        Внимание! <br>
        Прием заявок на обучение в декабре 2020 г. завершен (за исключением программы "Технологии бережливого производства: 5С без потерь")
      </p>
      <p>Горячая линия: + 7 (4932) 20-17-20</p>
    </div>
  </div>
</header>

<main id="app">
  {{ $slot }}
</main>

<x-footer />

</body>
</html>

