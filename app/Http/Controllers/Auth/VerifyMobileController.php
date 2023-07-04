<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class VerifyMobileController extends Controller
{
    public function __invoke(Request $request)
    {
        //Redirect user to dashboard if mobile already verified
        if ($request->user()->hasVerifiedMobile()) {
            return redirect()->to(RouteServiceProvider::HOME);
        }

        $request->validate([
            'code' => ['required', 'numeric'],
        ]);

        // Code correct
        if ($request->code === auth()->user()->mobile_verify_code) {
            $request->user()->markMobileAsVerified();

            return redirect()->to(RouteServiceProvider::HOME)->with(['message' => __('mobile.verified')]);
        }

        return back()->withErrors(['error' => __('mobile.error_code')]);

    }
}
