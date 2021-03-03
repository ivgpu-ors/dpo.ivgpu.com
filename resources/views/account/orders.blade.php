<?php /** @var App\Models\Order[] $orders */ ?>
<x-layouts.default title="Список ваших курсов" description="">
  <div class="container py-6 px-4">
    <h1>Мои курсы</h1>
    @if(session('success_paid'))
      <div class="border border-green-600 bg-green-200 p-3 rounded-md mb-3" role="status" aria-live="polite">
        Вы успешно оплатили доступ к курсу.
      </div>
    @endif

    @forelse($orders as $order)
      <x-account.order :order="$order" />
    @empty
      <p>Вы еще не записались ни на один курс. <a href="/">Вы можете выбрать любой</a></p>
    @endforelse
  </div>
</x-layouts.default>
