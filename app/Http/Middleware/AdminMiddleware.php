<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {     // Vérification des informations d'administrateur
        $user = Auth::user();
        dd($user->password);
        if ($user && $user->name === 'zenwex.com' && $user->password === 'dominique2006') {
            return $next($request);
        }

        // Rediriger si l'utilisateur n'est pas un administrateur
        return redirect('/login')->with('error', 'Accès refusé. Vous devez être administrateur.');

    }
}
