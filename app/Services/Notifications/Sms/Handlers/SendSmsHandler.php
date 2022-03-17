<?php

namespace App\Services\Notifications\Sms\Handlers;

use App\Services\Notifications\Sms\DTOs\SmsDTO;
use App\Services\Notifications\Sms\Providers\SmsProvider;

class SendSmsHandler
{
    private SmsProvider $smsProvider;

    public function __construct(SmsProvider $smsProvider)
    {
        $this->smsProvider = $smsProvider;
    }

    public function handle(SmsDTO $smsDTO): void
    {
        $this->smsProvider->send($smsDTO);
    }

}
