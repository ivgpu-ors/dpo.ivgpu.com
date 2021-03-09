<?php
/** @var App\Models\Option[] $options */
/** @var App\Models\Course $course */
?>
<div>
  <div class="inline-flex flex-col lg:flex-row">
    @foreach($options as $option)
      <div class="flex flex-1 flex-col mb-6 mx-3 lg:mb-0 p-4 border border-gray-400"  itemprop="offers" itemscope itemtype="https://schema.org/Offer">
        <meta itemprop="priceCurrency" content="RUB" />
        <meta itemprop="price" content="{{ $option->pivot->price }}" />

        <div class="bg-gray-200 p-4 text-dark text-center">{{ $option->name }}</div>

        <ul class="p-4 flex-grow" itemprop="description">
          @foreach($option->capacities as $capacity)
            <li class="mb-3">
              <span aria-hidden="true" rel="icon">
                <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" class="h-4 inline">
                  <path d="m24 72 32 40 48-96" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-miterlimit="1" stroke-width="16" />
                </svg>
              </span>
              {{ $capacity }}
            </li>
          @endforeach
        </ul>

        @if($option->caption)
        <div class="p-4">
          <p>* <em>{{ $option->caption }}</em></p>
        </div>
        @endif

        <div class="p-4 text-center">
          @if($option->pivot->price > 0)
            <span class="text-4xl font-semibold">
              {{ number_format($option->pivot->price, 0, ',', ' ') }} ₽
            </span>
          @else
            <span class="text-4xl font-semibold">Бесплатно</span>
          @endif
        </div>

        @if($course->active)
          <a href="{{ route('courses.signup', [$course, $option]) }}" class="block bg-red-500 hover:bg-red-600 w-2/3 mx-auto p-3 text-white text-center">Записаться на курс</a>
        @else
          <div class="block bg-gray-200 w-2/3 mx-auto p-3 text-center">Прием заявок завершен</div>
        @endif

      </div>
    @endforeach
  </div>
</div>
