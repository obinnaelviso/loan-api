<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class AuthorizeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
