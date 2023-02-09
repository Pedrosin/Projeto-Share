<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;


class AuthController extends Controller
{
    public function githubRedirect(Request $request)
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback(Request $request)
    {
        $githubData = Socialite::driver('github')->user();
        $registredUser = User::where('email', $githubData->email)->first();

        if ($registredUser) {
            Auth::login($registredUser);
        } else {
            $uuid = Str::uuid()->toString();
            $user = new User();
            $user->name = $githubData->name;
            $user->email = $githubData->email;
            $user->password = bcrypt($uuid);
            $user->auth_type = 'github';
            $user->id_tipo = 1;
            $user->save();
            Auth::login($user);
        }
        return redirect('/explorar');
    }

    public function googleRedirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        $googleData = Socialite::driver('google')->user();
        $registredUser = User::where('email', $googleData->email)->first();
        if ($registredUser) {
            Auth::login($registredUser);
        } else {
            $uuid = Str::uuid()->toString();
            $user = new User();
            $user->name = $googleData->name;
            $user->email = $googleData->email;
            $user->password = bcrypt($uuid);
            $user->auth_type = 'google';
            $user->id_tipo = 1;
            $user->save();
            Auth::login($user);
        }

        return redirect('/explorar');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'auth_type' => 'email'
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
