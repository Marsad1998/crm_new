<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function redirectTo()
    {
        // Check if the user is authenticated and belongs to a specific subdomain
        // if (Auth::check() && $subdomain = Auth::user()->subdomain) {
        //     // Modify this line to fit your tenancy logic
        //     return config('app.url') . '/' . $subdomain;
        // }

        // Default redirection if no subdomain is specified
        return '/';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
