<?php /** @var App\Models\Course[]|Illuminate\Support\Enumerable $courses */ ?>
<section class="flex flex-wrap mb-16 courses-grid">
  @foreach($courses as $course)
    <x-courses.card :course="$course" />
  @endforeach
</section>
