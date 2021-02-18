<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', config('app.name'))</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="index-page h-screen pt-12">

<section id="top" class="fixed top-0 w-full bg-white shadow-md z-50">
  <div class="container mx-auto h-12 flex items-center px-4">
    <h1 class="font-semibold text-xl text-gray-700 mb-0 hidden lg:block">{{ config('app.name') }}</h1>
  </div>
</section>

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

<div id="app">
  @yield('content')
</div>

</body>
</html>
