@extends('layouts.index')

<?php
  /** @var $courses \App\Models\Course[] */
?>

@section('content')
  <div class="container p-4">
    <section class="my-16 text-gray-600">
      <p>
        <strong>Уважаемые посетители!</strong> <br>
        Перед Вами — платформа услуг дополнительного образования, агрегирующая информацию обо всех программах для
        детей и взрослых, предлагаемых Ивановским государственным политехническим университетом.
      </p>
    </section>
    <section class="grid lg:grid-cols-4 gap-8 mb-16">
      @foreach($courses as $course)
        <article class="border border-gray-400 rounded shadow-md flex flex-col justify-between overflow-hidden">
          <header class="p-2">
            <img src="{{ Storage::url($course->image->file) }}" alt="Изображение для {{ $course->name }}"
                 class="object-cover h-48 w-full mb-3"
                 srcset="{{ $course->image->image_srcset }}" sizes="350px">

            @if($course->start)
              <div class="text-gray-500 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" class="h-6 inline">
                  <path
                    style="fill:currentColor;fill-opacity:1;stroke:none"
                    d="M 6 3 C 6 3 5 2.99997 5 4 L 3 4 L 3 7 L 3 18 L 3 19 L 19 19 L 19 18 L 19 7 L 19 4 L 17 4 C 17 2.99997 16 3 16 3 L 13 3 C 13 3 12 2.99997 12 4 L 10 4 C 10 2.99997 9 3 9 3 L 6 3 z M 6 4 L 9 4 L 9 5 L 6 5 L 6 4 z M 13 4 L 16 4 L 16 5 L 13 5 L 13 4 z M 4 7 L 18 7 L 18 18 L 4 18 L 4 7 z M 6 8 L 6 10 L 8 10 L 8 8 L 6 8 z M 10 8 L 10 10 L 12 10 L 12 8 L 10 8 z M 14 8 L 14 10 L 16 10 L 16 8 L 14 8 z M 6 11 L 6 13 L 8 13 L 8 11 L 6 11 z M 10 11 L 10 13 L 12 13 L 12 11 L 10 11 z M 14 11 L 14 13 L 16 13 L 16 11 L 14 11 z M 14 14 L 14 16 L 16 16 L 16 14 L 14 14 z "
                    class="ColorScheme-Text"
                  />
                </svg>
                с {{ $course->start->format('d.m.Y') }}
              </div>
            @endif

            <h1 class="text-base text-gray-500">{{ $course->name }}</h1>
          </header>
          <footer>
            @if($course->enabled)
              <a href="" class="bg-primary text-light w-full h-full block p-2 text-center hover:bg-primary-dark">Иде прием заявок</a>
            @else
              <a href="" class="bg-gray-500 hover:bg-gray-700 text-light w-full h-full block p-2 text-center">Прием заявок завершен</a>
            @endif
          </footer>
        </article>
      @endforeach
    </section>
  </div>
@endsection
