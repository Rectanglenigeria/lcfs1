<?php

namespace App\Http\Middleware;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Closure;

class RedirectIfProfileNotComplete
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
        $user= User::where('id',Auth::user()->id)->first();
        if($user->is_active=='1'){
            if($user->name !=null && $user->account_name != null && $user->account_no != null && $user->bank != null){

                        return $next($request);

            }else{
              return Redirect::to('/user_profile')->with('notification','Take few minutes to complete your profile below.');
            }

        }else{
            return Redirect::to('/activate_user/'.$user->id)->with('notification','Account yet to be verified! Verification code was sent to your phone. Enter the code below.');
        }

        
    }
}
