<?php
// app/Http/Controllers/Auth/LoginController.php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendingUser;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        $user->last_login_at = now();
        $user->save();

  
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $pendingUser = PendingUser::where('email', $request->email)->first();

        if ($pendingUser) {
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is not yet approved. Please wait for approval.',
            ]);
        }

        return redirect()->route('login')->withErrors([
            'email' => trans('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->last_logout_at = now();
            $user->save();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); 
    }

}