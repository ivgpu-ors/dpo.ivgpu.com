<?php /** @var App\Models\Course[]|Illuminate\Support\Enumerable $courses */ ?>
<section class="grid lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-16">
  @foreach($courses as $course)
    <x-courses.card :course="$course" />
  @endforeach
</section>
