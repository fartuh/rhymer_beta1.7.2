<?php

namespace App\Http\Middleware;

use Closure;

class authId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
                    $this->auth = $auth;
                        
    }

    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();
        view()->share('user', $user);

        return $next($request);
    }
}
