<?php /** @var App\Models\Option[] $options */ ?>
<div class="text-center">
  <div class="inline-flex flex-col lg:flex-row mx-auto lg:shadow-lg lg:border border-gray-400 lg:overflow-hidden lg:rounded-lg text-left">
    @foreach($options as $option)
      <div class="w-72 flex flex-col mb-6 lg:mb-0 rounded-xl lg:rounded-none shadow-lg lg:shadow-none
                  overflow-hidden border border-gray-600 lg:border-t-0 lg:border-l-0 lg:border-b-0 lg:border-r
                  lg:last:border-0 lg:border-gray-400">
        <div class="bg-gray-700 p-4 text-light">{{ $option->name }}</div>

        <div class="p-4 flex-grow">
          @foreach($option->capacities as $capacity)
            <p>
              <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" class="h-4 inline">
                <path d="m24 72 32 40 48-96" fill="none" stroke="currentColor" stroke-linecap="round"
                      stroke-linejoin="round" stroke-miterlimit="1" stroke-width="16"/>
              </svg>
              {{ $capacity }}
            </p>
          @endforeach
        </div>

        @if($option->caption)
        <div class="p-4">
          <p>* <em>{{ $option->caption }}</em></p>
        </div>
        @endif

        <div class="p-4 text-center">
          @if($option->pivot->price > 0)
            <span class="text-4xl font-head font-semibold text-primary">{{ $option->pivot->price }}</span> руб.
          @else
            <span class="text-4xl font-head font-semibold text-primary">Бесплатно</span>
          @endif
        </div>

        <a href="" class="block bg-red-400 text-light text-center py-4 uppercase hover:bg-red-500">Записаться на курс</a>
      </div>
    @endforeach
  </div>
</div>
