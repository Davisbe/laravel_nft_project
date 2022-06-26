<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
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
        if (Auth::check() and ($request->path() == 'auth/login' or $request->path() == 'auth/register')) {
            return back();
        }

        if (!Auth::check() and ($request->path() == 'auth/logout')) {
            return back();
        }

        if (!Auth::check() and ($request->is('nft/listing/*'))) {
            return response()->view('login');
        }

        if (!Auth::check() and ($request->is('collection/view/new/purchace/*'))) {
            return response()->view('login');
        }

        return $next($request);
    }
}
