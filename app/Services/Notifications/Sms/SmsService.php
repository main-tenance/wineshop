<?php

namespace App\Services\Notifications\Sms;

use App\Jobs\QueueName;
use App\Services\Notifications\Sms\DTOs\SmsDTO;
use App\Services\Notifications\Sms\Jobs\SendSmsJob;

class SmsService
{
    public function sendSms(SmsDTO $smsDTO): void
    {
        SendSmsJob::dispatch($smsDTO)->onQueue(QueueName::DEFAULT_QUEUE);
    }

}
