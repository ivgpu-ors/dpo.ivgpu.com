<?php

namespace App\Http\Middleware;

use App\Ivgpu\Services\ApiService;
use Closure;
use Illuminate\Http\Request;

class Member
{
    /**
     * @var ApiService
     */
    private ApiService $api;

    /**
     * Member constructor.
     * @param ApiService $api
     */
    public function __construct(ApiService $api)
    {
        $this->api = $api;
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
        if ($user && !in_array('DPO_MEMBER', $user->roles)) {
            $user->roles = array_merge($user->roles, ['DPO_MEMBER']);
            $user->save();
            $this->api->appendRoles($user->id, ['DPO_MEMBER']);
        }

        return $next($request);
    }
}
