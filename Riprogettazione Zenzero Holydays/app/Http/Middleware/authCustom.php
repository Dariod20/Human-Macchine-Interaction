<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class authCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        session_start();

        if (!(session('logged'))) {
                // Aggiungi il messaggio di feedback
            session()->flash('login_feedback', trans('messages.login_feedback'));
            // Salva l'URL corrente come URL di ritorno
            session(['return_url' => route('calendario')]);  // Indirizza al calendario
            return Redirect::to(route('user.login'));
        }

        return $next($request);
    }
}
