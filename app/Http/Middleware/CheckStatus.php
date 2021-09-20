<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request);
        
        if (auth()->user()) {
            return $next($request);
        }

        session()->flash('message', 'Please login to access profile page!');
            session()->flash('alert-class', 'alert-info');
            return redirect()->route('user.show.login');
    }
}
