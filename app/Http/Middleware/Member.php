<?php

namespace App\Http\Middleware;

use App\Ivgpu\IvgpuGuard;
use App\Ivgpu\Services\ApiService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Member
{
    /**
     * @var ApiService
     */
    private ApiService $api;
    /**
     * @var IvgpuGuard
     */
    private $guard;

    /**
     * Member constructor.
     * @param ApiService $api
     */
    public function __construct(ApiService $api)
    {
        $this->api = $api;
        $this->guard = Auth::guard();
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $roles = $user->roles ?? [];
        if ($user && !in_array('DPO_MEMBER', $roles)) {
            $user->roles = array_merge($roles, ['DPO_MEMBER']);
            $user->save();
            $this->guard->appendRole('DPO_MEMBER');
        }

        return $next($request);
    }
}
