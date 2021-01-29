<?php


namespace App\Ivgpu\Services;


use App\Ivgpu\Interfaces\TokenProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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

    public function setToken(string $token)
    {
        $host = explode('.', $this->request->getHost());
        $cookie_domain = '.' . $host[count($host)-2] . "." . $host[count($host)-1];

        $cookie = Cookie::forever($this->cookie_name, $token, '/', $cookie_domain);
        Cookie::queue($cookie);
    }
}
