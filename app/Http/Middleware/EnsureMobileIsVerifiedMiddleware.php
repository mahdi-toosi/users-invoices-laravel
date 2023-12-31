<?php

namespace App\Http\Middleware;

use App\Interface\MustVerifyMobile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureMobileIsVerifiedMiddleware
{
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyMobile &&
                ! $request->user()->hasVerifiedMobile())) {
            return $request->expectsJson()
                ? abort(403, 'Your mobile number is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'verification-mobile.notice'));
        }

        return $next($request);
    }
}
