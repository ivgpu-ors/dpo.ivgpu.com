<?php /** @var $courses App\Models\Course[] */ ?>
<x-layouts.index>
  <div class="container p-4">
    <section class="my-16 text-gray-600">
      <p>
        <strong>Уважаемые посетители!</strong> <br>
        Перед Вами — платформа услуг дополнительного образования, агрегирующая информацию обо всех программах для
        детей и взрослых, предлагаемых Ивановским государственным политехническим университетом.
      </p>
    </section>
    <x-courses.pack :courses="$courses" />
  </div>
</x-layouts.index>
