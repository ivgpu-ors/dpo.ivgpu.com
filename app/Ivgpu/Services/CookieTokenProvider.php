<?php


namespace App\Ivgpu\Services;


use App\Ivgpu\Interfaces\TokenProvider;
use Illuminate\Http\Request;

class CookieTokenProvider implements TokenProvider
{
    protected Request $request;
    protected string $cookie_name;

    /**
     * CookieTokenProvider constructor.
     * @param Request $request
     * @param $cookie_name
     */
    public function __construct(Request $request, string $cookie_name)
    {
        $this->request = $request;
        $this->cookie_name = $cookie_name;
    }

    public function hasToken(): bool
    {
        return $this->request->cookies->has($this->cookie_name);
    }

    public function getToken(): string
    {
        return $this->request->cookie($this->cookie_name);
    }
}
