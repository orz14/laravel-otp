<?php

namespace App\Http\Controllers;

use App\Helpers\OTP as HelpersOTP;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class OTPController extends Controller
{
    public function index()
    {
        return view('otp');
    }

    public function store(Request $request)
    {
        $digits = env('OTP_LENGTH');
        $request->validate([
            'otp' => 'required|numeric|digits:' . $digits
        ]);

        $user = $request->user();
        $otp = Otp::where('user_id', $user->id)->first();

        if (!is_null($otp)) {
            $otp_data = Crypt::decryptString($otp->secret);

            if ($request->otp == $otp_data) {
                if (Carbon::now() > $otp->expires_at) {
                    return back()->with('status', [
                        'type' => 'error',
                        'message' => 'OTP code expired, please resend'
                    ]);
                }

                Session::put('session_otp_' . $user->id, true);
                HelpersOTP::clear($user->id);

                return to_route('home');
            } else {
                return back()->with('status', [
                    'type' => 'error',
                    'message' => 'Invalid OTP code'
                ]);
            }
        } else {
            return back()->with('status', [
                'type' => 'error',
                'message' => 'OTP code not found, please resend'
            ]);
        }
    }

    public function resend(Request $request)
    {
        $user = $request->user();

        HelpersOTP::clear($user->id);

        HelpersOTP::generate($user, 'create');

        return back()->with('status', [
            'type' => 'success',
            'message' => 'OTP code sent successfully'
        ]);
    }
}
