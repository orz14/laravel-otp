<?php

namespace App\Helpers;

use App\Mail\OTPMail;
use App\Models\Otp as ModelsOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class OTP
{
    public static function generate($user, $action)
    {
        $digits = (int) env('OTP_LENGTH');
        $min = pow(10, $digits - 1);
        $max = pow(10, $digits) - 1;
        $otp = rand($min, $max);

        $minutes = (int) env('OTP_EXPIRE_MINUTES');
        $expired = Carbon::now()->addMinutes($minutes);

        if ($action == 'create') {
            ModelsOtp::create([
                'user_id' => $user->id,
                'secret' => Crypt::encryptString($otp),
                'expires_at' => $expired
            ]);
        } elseif ($action == 'update') {
            ModelsOtp::where('user_id', $user->id)->update([
                'secret' => Crypt::encryptString($otp),
                'expires_at' => $expired
            ]);
        }

        Mail::to($user->email)->send(new OTPMail([
            'name' => $user->name,
            'otp' => $otp
        ]));
    }
}
