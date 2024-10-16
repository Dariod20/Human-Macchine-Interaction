<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isRegisteredOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se la sessione ha un ruolo e se è 'admin' o 'registered_user'
        if (session('role') !== 'admin' && session('role') !== 'registered_user') {
            // Se non è né admin né registered_user, mostra una pagina di errore
            return response()->view('errors.404', ['message' => 'Solo gli amministratori o gli utenti esterni registrati possono accedere a questa pagina!']);
        }

        return $next($request);    }
}
