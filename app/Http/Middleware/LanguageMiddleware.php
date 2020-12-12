<?php

namespace App\Http\Middleware;

use Closure;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(empty(session('locale')) OR session('locale') == NULL OR session('locale') == ''){
            $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            session(['locale' => $lang]);
        }

        app()->setLocale(session('locale'));

        return $next($request);
    }
}
