<?php

namespace App\Services\Notifications\Sms\Providers;

use App\Services\Notifications\Sms\DTOs\SmsDTO;
use Illuminate\Support\Facades\Log;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class LogSmsProvider implements SmsProvider
{

    public function send(SmsDTO $smsDTO): void
    {
        $basic = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $client = new Client($basic);
        $client->sms()->send(new SMS(
            $smsDTO->getTo(),
            $smsDTO->getFrom(),
            $smsDTO->getBody()
        ));
        Log::debug('LogSmsProvider', [
            $smsDTO->getFrom(),
            $smsDTO->getTo(),
            $smsDTO->getBody(),
        ]);
    }
}
