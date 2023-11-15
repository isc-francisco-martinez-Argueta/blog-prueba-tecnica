<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle($request, Closure $next)
    {
        // Verificar si la clave API está presente en la solicitud
        $apiKey = $request->header('Blog-API-Key');

        if (!$apiKey || $apiKey !== env('API_KEY')) {
            return response()->json(['message' => 'Acceso no autorizado. Clave API inválida.'], 401);
        }

        return $next($request);
    }
}
