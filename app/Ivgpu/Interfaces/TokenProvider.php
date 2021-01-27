<?php


namespace App\Ivgpu\Interfaces;

interface TokenProvider
{
    public function hasToken(): bool;

    public function getToken(): string;
}
