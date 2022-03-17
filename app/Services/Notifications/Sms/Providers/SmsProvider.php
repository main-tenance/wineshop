<?php

namespace App\Services\Notifications\Sms\Providers;

use App\Services\Notifications\Sms\DTOs\SmsDTO;

interface SmsProvider
{
    public function send(SmsDTO $smsDTO): void;
}
