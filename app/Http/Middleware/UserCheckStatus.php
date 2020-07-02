<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Session;

class UserCheckStatus
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
        $user = Auth::user();
        app()->setLocale($user->locale);
        Session::put('locale', $user->locale);
        
        if ($user->status=='blocked') {
            Auth::guard()->logout();
            $request->session()->invalidate();
            return redirect()->route('login')->withErrors(['error' => 'Your account has been blocked']);
            //return redirect()->route('login')->with('error', 'Your account has been blocked');;
        }
        return $next($request);
    }
}
