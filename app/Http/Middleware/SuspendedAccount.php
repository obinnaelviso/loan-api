<?php

namespace App\Http\Middleware;

use App\Services\GenerateTokenService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuspendedAccount
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
        $tokenService = app(GenerateTokenService::class);
        if (auth()->check()) {
            if (auth()->user()->status_id == status_suspended_id()) {
                $tokenService->revokeLoginToken();
                session()->flush();
                if ($request->expectsJson()) {
                    return apiError('Your account is suspended.', Response::HTTP_UNAUTHORIZED);
                } else {
                    auth()->logout();
                    return redirect('/login')->with('error', 'Your account is suspended.');
                }
            }
        }
        return $next($request);
    }
}
