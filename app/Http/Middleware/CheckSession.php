<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(!session()->has('user')){
            if($request->fullUrl()!=url('/')){
                session()->put('redirect',$request->fullUrl());
            }            
            return redirect()->route('login');
        }
        
        return $next($request);
    }
}
