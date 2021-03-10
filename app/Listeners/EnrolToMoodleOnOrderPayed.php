<?php

namespace App\Listeners;

use App\Events\OrderPayed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EnrolToMoodleOnOrderPayed implements ShouldQueue
{
    private string $url;
    private string $secret;
    private string $courseRegex;
    private int $courseIdMatch;

    public function __construct()
    {
        $this->url = config('moodle.course_enrol_url');
        $this->secret = config('moodle.course_enrol_secret');
        $this->courseRegex = config('moodle.course_regex');
        $this->courseIdMatch = intval(config('moodle.course_id_match'));
    }

    public function handle(OrderPayed $event)
    {
        if (!preg_match("/{$this->courseRegex}/", $event->order->course->content_url, $matches)) {
            return;
        }

        $data = [
            'secret' => $this->secret,
            'user_email' => $event->order->user->email,
            'course_id' => $matches[$this->courseIdMatch],
        ];

        $response = Http::asForm()->post($this->url, $data);
        Log::debug('Enrol to moodle', ['response' => $response ,'data' => $data]);
    }
}
