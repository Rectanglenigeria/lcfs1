<?php

namespace App\Http\Middleware;


use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Closure;

class RedirectIfBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $getUser=User::where('id', Auth::user()->id)->first();
        if($getUser->is_block == 1){
            return Redirect::to('/user/block')->with('notification','You have been blocked from the system.');
        }else{
            return $next($request);
        }
        
    }
}
