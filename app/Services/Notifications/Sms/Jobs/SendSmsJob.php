<?php

namespace App\Services\Notifications\Sms\Jobs;

use App\Services\Notifications\Sms\DTOs\SmsDTO;
use App\Services\Notifications\Sms\Handlers\SendSmsHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SmsDTO $smsDTO;

    public function __construct(SmsDTO $smsDTO)
    {
        $this->smsDTO = $smsDTO;
    }

    private function getSendSmsHandler()
    {
        return app(SendSmsHandler::class);
    }

    public function handle(): void
    {
        $this->getSendSmsHandler()->handle($this->smsDTO);
    }

}
