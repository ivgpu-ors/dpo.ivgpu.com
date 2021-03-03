<?php
/** @var App\Models\Course $course */
/** @var App\Models\Option $option */
?>
<x-layouts.default :title="'Запись на курс - ' . $course->name"
                   :description="exert($course->description)">
  <div class="h-full py-10">
    <div class="container px-4">
      <h1>Запись на курс</h1>
      <h2 class="text-xl lg:text-3xl">{{ $course->name }}</h2>
      <div class="bg-white rounded-md shadow-lg border border-gray-200 overflow-hidden">
        <div class="block lg:hidden">
          <div class="bg-gray-700 text-light uppercase text-sm font-semibold px-4 py-3">Начало</div>
          <div class="px-4 py-3">
            @if($course->start)
              {{ $course->start->formatLocalized('%d %b %Y') }}
            @else
              Не указано
            @endif
          </div>

          <div class="bg-gray-700 text-light uppercase text-sm font-semibold px-4 py-3">Длительность</div>
          <div class="px-4 py-3">
            {{ $course->duration }}
          </div>

          <div class="bg-gray-700 text-light uppercase text-sm font-semibold px-4 py-3">Руководитель программы</div>
          <div class="px-4 py-3">
            @if($course->leader_id)
              {{ $course->leader->full_name }}
            @else
              Не указано
            @endif
          </div>

          <div class="bg-gray-700 text-light uppercase text-sm font-semibold px-4 py-3">Стоимость</div>
          <div class="px-4 py-3">
            @if($option->pivot->price > 0)
              <span class="font-semibold">{{ number_format($option->pivot->price, 0, ',', ' ') }} ₽</span>
            @else
              <span class="font-semibold">Бесплатно</span>
            @endif
          </div>
        </div>

        <table class="min-w-full bg-white hidden lg:table">
          <thead class="bg-gray-700 text-light uppercase text-sm font-semibold">
          <tr>
            <td class="px-4 py-3">Начало</td>
            <td class="px-4 py-3">Длительность</td>
            <td class="px-4 py-3">Руководитель программы</td>
            <td class="px-4 py-3 w-1/12">Стоимость</td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td class="px-4 py-3">
              @if($course->start)
                {{ $course->start->formatLocalized('%d %b %Y') }}
              @else
                Не указано
              @endif
            </td>
            <td class="px-4 py-3">
              {{ $course->duration }}
            </td>
            <td class="px-4 py-3">
              @if($course->leader_id)
                {{ $course->leader->full_name }}
              @else
                Не указано
              @endif
            </td>
            <td class="px-4 py-3">
              @if($option->pivot->price > 0)
                <span class="font-semibold">{{ number_format($option->pivot->price, 0, ',', ' ') }} ₽</span>
              @else
                <span class="font-semibold">Бесплатно</span>
              @endif
            </td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="my-6">
        <form action="{{ route('courses.order', [$course, $option]) }}" method="POST">
          @csrf
          <input type="checkbox" value="1" name="contract_accept" id="contract_accept">
          <label for="contract_accept">Согласен с условиями <a href="{{ asset('docs/contract_accept.pdf') }}" target="_blank">договора оферты</a></label>
          @error('contract_accept')
            <small class="text-red-500">{{ $message }}</small>
          @enderror
          <button class="block w-full lg:w-auto px-4 py-3 text-light mt-4 bg-primary">Записаться</button>
        </form>
      </div>
    </div>
  </div>
</x-layouts.default>
