<?php /** @var App\Models\Course $course */ ?>
<x-layouts.default :title="$course->name">
  <header class="relative text-light lg:h-96">
    <img src="{{ $course->image->image_src }}" srcset="{{ $course->image->image_srcset }}"
         sizes="{{ $course->image->image_sizes }}"
         aria-hidden="true" alt=""
         class="w-full h-full absolute object-cover">

    <div class="relative bg-dark bg-opacity-50 h-full lg:flex flex-col justify-center">
      <div class="container lg:max-w-2xl px-4 py-6">
        <h1 class="text-2xl lg:text-4xl mb-8 lg:mb-12">{{ $course->name }}</h1>
        <div class="lg:flex justify-between">

          <x-courses.duration :duration="$course->duration" class="mb-6" />
          <x-courses.education_time :education_time="$course->education_time" />

        </div>
      </div>
    </div>
  </header>

  <div class="container px-4 py-6">
    <h2>О курсе</h2>
    {!! $course->description !!}

    <h2 class="mt-8">Программа курса</h2>
    {!! $course->program !!}

    @if($course->options->count())
      <x-courses.options :options="$course->options" :course="$course" />
    @endif

    @if($course->target_audience)
      <h2 class="mt-8">Целевая аудитория</h2>
      {!! $course->target_audience !!}
    @endif

    <h2 class="mt-8">Форма реализации</h2>
    {{ $course->impl_form }}

    @if($course->conditions)
      <h2 class="mt-8">Дополнительные технические условия, необходимые для прохождения программы</h2>
      {!! $course->conditions !!}
    @endif

    @if($course->leader)
      <h2 class="mt-8">Руководитель программы</h2>
      <p>
        <strong>{{ $course->leader->full_name }}</strong> <br>
        {{ $course->leader->post }}
      </p>
    @endif

    @if($course->teachers->count())
      <h2 class="mt-8">Преподаватели курса</h2>
      @foreach($course->teachers as $teacher)
        <p>
          <strong>{{ $teacher->full_name }}</strong> <br>
          {{ $teacher->post }}
        </p>
      @endforeach
    @endif
  </div>
</x-layouts.default>
