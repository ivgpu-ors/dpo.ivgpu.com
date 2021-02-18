<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    public function __invoke()
    {
        $courses = $this->getCourses();

        return view('index', [
            'courses' => $courses,
        ]);
    }

    /**
     * @return Course[]|Collection
     */
    private function getCourses()
    {
        return Course::with('image')
            ->select(['id', 'name', 'start', 'enabled', 'image_id'])
            ->orderBy('enabled', 'desc')
            ->get();
    }
}
