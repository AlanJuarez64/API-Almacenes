<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Autenticacion
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
        $tokenHeader = [ "Authorization" => $request -> header("Authorization")];

        $response = Http::withHeaders($tokenHeader) -> get("http://localhost:8001/api/v1/validate");
        if($response -> successful())
            return $next($request);
        return response(["message" => "No autorizado"], 403);
    }
}
