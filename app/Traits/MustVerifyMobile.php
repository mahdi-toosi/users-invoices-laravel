<?php

namespace App\Traits;

use MessageWay\MessageWayLaravel\Facades\MessageWayLaravel;

trait MustVerifyMobile
{
    public function hasVerifiedMobile(): bool
    {
        return ! is_null($this->mobile_verified_at);
    }

    public function markMobileAsVerified(): bool
    {
        return $this->forceFill([
            'mobile_verify_code' => null,
            'mobile_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendMobileVerificationNotification(bool $newData = false): void
    {
        $code = random_int(111111, 999999);

        if ($newData) {
            $this->forceFill([
                'mobile_verify_code' => $code,
            ])->save();
        }

        MessageWayLaravel::sendViaSMS(
            auth()->user()->mobile_number,
            env('MESSAGE_WAY_TEMPLATE_ID'),
            0, ['code' => $code]
        );
    }
}
