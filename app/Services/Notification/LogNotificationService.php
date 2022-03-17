<?php


namespace App\Services\Notification;


use Illuminate\Log\LogManager;

class LogNotificationService implements NotificationServiceInterface
{
    private LogManager $logger;
    /**
     * @var int
     */
    private int $count;

    public function __construct(LogManager $logger, int $count = 0)
    {
        $this->logger = $logger;
        $this->count = $count;
    }

    public function notify(string $text): int
    {
//        for ($i = 0; $i < $this->count; $i++) {
        $this->logger->info($text);
//        }
        return ++$this->count;
    }
}
