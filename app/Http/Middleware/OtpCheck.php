<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OtpCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return to_route('login');
        }

        $otp = $request->user()->with_otp;
        $session = Session::get('session_otp_' . $request->user()->id);

        if (($otp == false)) {
            return to_route('home');
        }

        if (($otp == true) && ($session == true)) {
            return to_route('home');
        }

        return $next($request);
    }
}
