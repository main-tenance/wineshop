<?php


namespace App\Services\Notification;


interface NotificationServiceInterface
{
    public function notify(string $text): int;
}
