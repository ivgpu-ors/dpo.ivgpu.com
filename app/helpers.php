<?php
if (! function_exists('exert')) {
    function exert(string $text, int $length = 125): string
    {
        $text = strip_tags($text);
        return mb_substr($text, 0, $length) . '...';
    }
}
