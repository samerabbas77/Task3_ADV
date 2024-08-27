<?php

namespace App\Http\Middleware;

use auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //$user = auth()->user();
       // if(auth()->user()->tokenCan('role:user') && $user->currentAccessToken()->tokenable_type == 
       /// 'App\Model\User'){
        return $next($request);
       /// }else{
       //     return response()->json("Not Authorize",401);
       // }
    }
}
