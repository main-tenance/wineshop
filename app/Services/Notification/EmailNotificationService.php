<?php


namespace App\Services\Notification;


use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailNotificationService implements NotificationServiceInterface
{
    private LogManager $logger;
    /**
     * @var int
     */
    private int $count;

    public function __construct()
    {
        $this->count = 0;
    }

    public function notify(string $text): int
    {
        Mail::raw(app('request')->ip(), function ($message) {
            $message->to('tagedo@yandex.ru')->subject('test');
        });
        return ++$this->count;
    }
}
