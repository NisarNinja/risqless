<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Subscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if($request->user() && ($request->user()->google_id !== null || $request->user()->fb_id !== null)){
        
            if($request->user()->subscribed('default') == null){

                return redirect()->route('card_details');
            }
        }
        else{
        if ($request->user() && !($request->user()->subscription('default')->onTrial() || $request->user()->subscribed('default') || $request->user()->subscription('default')->onGracePeriod())){
            session()->flash('trail_expire', 'Expired');

             return redirect()->route('home');
        }

    
        }
    return $next($request);
    }
}
