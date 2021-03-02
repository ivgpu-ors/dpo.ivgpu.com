<?php /** @var App\Models\Order $order */ ?>
<article class="p-2 shadow-md ring-1 ring-gray-400 rounded-md flex items-start">
  <div class="flex-grow">
    <h1 class="text-xl">{{ $order->course->name }}</h1>
    <div class="flex flex-wrap lg:flex-nowrap">

      <div class="w-full lg:w-1/3">
        <strong>Начало</strong> <br>
        {{ $order->course->start->formatLocalized('%d %b %Y') }}
      </div>

      <div class="w-full lg:w-1/3">
        <strong>Длительность</strong> <br>
        {{ $order->course->duration }}
      </div>

      <div class="w-full lg:w-1/3">
        <strong>Руководитель программы</strong><br>
        {{ $order->course->leader->full_name }}
      </div>

    </div>
  </div>
  <footer>
    @if($order->status->equals(\App\Enums\OrderStatus::paid()))
      <a href="/" class="bg-primary hover:bg-primary-dark inline-block p-2 rounded-md text-white">Перейти к курсу</a>
    @else
      <a href="{{ route('order.register', $order) }}" class="bg-red-500 hover:bg-red-600 inline-block p-2 rounded-md text-white">Оплатить курс</a>
    @endif
  </footer>
</article>
