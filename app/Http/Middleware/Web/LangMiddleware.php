<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(in_array($request->query('lang'), ['en', 'id'])) {
            $lang = $request->query('lang');
            session()->put('lang', $lang);
        } else {
            $lang = session('lang') ?? 'id';
        }

        App::setLocale($lang);
        return $next($request);
    }
}
