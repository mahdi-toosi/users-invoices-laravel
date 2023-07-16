<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\MustVerifyMobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MessageWay\MessageWayLaravel\Facades\MessageWayLaravel;

class ForgotPasswordController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetMobiles, MustVerifyMobile;

    public function getResetCode( Request $request ) {
        $user = User::query()
                    ->where( 'mobile_number', $request['mobile_number'] )
                    ->firstOrFail();
        $code = random_int( 111111, 999999 );

        $user->forceFill( [
            'mobile_verify_code' => $code,
        ] )->save();

        MessageWayLaravel::sendViaSMS(
            $user->mobile_number,
            env( 'MESSAGE_WAY_TEMPLATE_ID' ),
            0, [ 'code' => $code ]
        );

        session( [ 'mobile_number' => $request['mobile_number'] ] );

        return redirect()->route( 'passwords.reset-password-by-code' );
    }

    public function ResetPassword( Request $request ) {
        $mobileNumber = session( 'mobile_number' );
        $request->validate( [
            'password' => 'required|string|min:8',
            'code'     => 'required',
        ] );

        $user = User::query()->where( 'mobile_number', $mobileNumber )
                    ->firstOrFail();

        if ( $user->mobile_verify_code != $request['code'] ) {
            return redirect()->back()->with( 'error',
                __( 'کد تایید درست نمی باشد.' ) );
        }

        $user->update( [
            'password' => Hash::make( $request['password'] ),
        ] );
        session()->forget( 'mobile_number' );

        return redirect()->route( 'login' )->with( 'success',
            __( 'رمزعبور با موفقیت تغییر کرد' ) );
    }

    public function resetPasswordByCode() {
        return view( 'auth.passwords.reset-password-by-code' );
    }
}
