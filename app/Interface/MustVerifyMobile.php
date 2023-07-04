<?php

namespace App\Interface;

interface MustVerifyMobile
{
    public function hasVerifiedMobile();

    public function markMobileAsVerified();

    public function sendMobileVerificationNotification();
}
