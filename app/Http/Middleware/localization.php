<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;  
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Session()->has('local')) {
            App::setLocale(Session()->get('local'));
        }

        if (Session::has('lang')) {
            App::setLocale(Session::get('lang'));
        }

        return $next($request);
    }
}
