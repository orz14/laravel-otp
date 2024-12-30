<?php

namespace App\Http\Controllers;

use App\Helpers\OTP as HelpersOTP;
use App\Models\Otp;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('index');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return to_route('login')->with('status', [
                'type' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        Auth::login($user);

        $request->session()->regenerate();

        if ($user->with_otp) {
            $otp = Otp::where('user_id', $user->id)->first();

            if (!is_null($otp)) {
                if (Carbon::now() > $otp->expires_at) {
                    HelpersOTP::generate($user, 'update');
                }
            } else {
                HelpersOTP::generate($user, 'create');
            }

            Session::put('session_otp_' . $user->id, false);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function registerIndex()
    {
        return view('register');
    }

    public function registerStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create($validated);

        event(new Registered($user));

        return to_route('login')->with('status', [
            'type' => 'success',
            'message' => 'Account created successfully'
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->user()->with_otp) {
            HelpersOTP::clear($request->user()->id);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login')->with('status', [
            'type' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}
