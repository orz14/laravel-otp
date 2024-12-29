<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function otpSetting(Request $request)
    {
        $user = $request->user();
        $with_otp = !$user->with_otp;

        $user->update([
            'with_otp' => $with_otp
        ]);

        if ($with_otp == true) {
            Session::put('session_otp_' . $user->id, true);
        } else {
            Session::forget('session_otp_' . $user->id);
        }

        return back()->with('status', [
            'type' => 'success',
            'message' => $user->with_otp ? '2FA enabled' : '2FA disabled'
        ]);
    }
}
