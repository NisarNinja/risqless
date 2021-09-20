<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {   
        // dd($request->user()->role == 'admin');
        if($request->user()->role == 'admin'){
            return $next($request);
        }
        else{
            Session::flash('unauth', 'You are not allowed to access Admin Area!');
            return redirect()->route('home');
        }
    }
}
