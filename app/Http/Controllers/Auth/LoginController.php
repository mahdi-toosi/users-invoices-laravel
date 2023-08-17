<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function redirectTo()
    {
        if (request()->user()->is_admin) {
            return RouteServiceProvider::HOME;
        }

        return route('me.invoices', null, false);
    }

    public function username()
    {
        return 'mobile_number';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
