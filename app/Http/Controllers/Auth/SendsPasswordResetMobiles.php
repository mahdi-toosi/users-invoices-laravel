<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

trait SendsPasswordResetMobiles {
    public function showLinkRequestForm() {
        return view( 'auth.passwords.mobile' );
    }

    public function sendResetLinkEmail( Request $request ) {
        $this->validateMobile( $request );

    }

    protected function validateMobile( Request $request ) {
        $request->validate( [ 'mobile_number' => 'required|exists:users,mobile_number|regex:/(0)[0-9]{10}/' ] );
    }

    protected function credentials( Request $request ) {
        return $request->only( 'mobile_number' );
    }

    protected function sendResetLinkResponse( Request $request, $response ) {
        return $request->wantsJson()
            ? new JsonResponse( [ 'message' => trans( $response ) ], 200 )
            : back()->with( 'status', trans( $response ) );
    }

    protected function sendResetLinkFailedResponse( Request $request, $response
    ) {
        if ( $request->wantsJson() ) {
            throw ValidationException::withMessages( [
                'email' => [ trans( $response ) ],
            ] );
        }

        return back()
            ->withInput( $request->only( 'email' ) )
            ->withErrors( [ 'email' => trans( $response ) ] );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker() {
        return Password::broker();
    }
}
