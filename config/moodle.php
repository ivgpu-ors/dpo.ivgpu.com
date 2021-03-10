<?php

return [
    'course_enrol_url' => env('MOODLE_ENROL_URL'),
    'course_enrol_secret' => env('MOODLE_ENROL_SECRET'),
    'course_regex' => '.*courses\.ivgpu\.com.*?id=(\d+).*',
    'course_id_match' => 1
];
