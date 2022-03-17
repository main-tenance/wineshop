<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\User;
use App\Services\Creators\Handlers\CreatorSendPdfCatalogHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendCreatorPdfCatalogJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public static string $onQueue = QueueName::SEND_PDF_QUEUE;

    public Creator $creator;
    public User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Creator $creator)
    {
        $this->onQueue(self::$onQueue);
        $this->creator = $creator;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info(json_encode([
            'job' => self::class,
            'isVip' => $this->user->isVip(),
            'user' => $this->user->only(['id', 'name', 'email']),
            'creator' => $this->creator->only(['id', 'name']),
        ], JSON_UNESCAPED_UNICODE));

        $this->getCreatorSendPdfCatalogHandler()->handle($this->user, $this->creator);
    }

    private function getCreatorSendPdfCatalogHandler(): CreatorSendPdfCatalogHandler
    {
        return app(CreatorSendPdfCatalogHandler::class);
    }

    /**
     * Handle a job failure.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
//        Log::channel('slack')->error(json_encode([
//            'job' => 'SendCreatorPdfCatalogJob',
//            'user' => $this->user->only(['id', 'name', 'email']),
//            'creator' => $this->creator->only(['id', 'name']),
//            'exception' => $exception->getMessage(),
//        ], JSON_UNESCAPED_UNICODE));
        Log::error(json_encode([
            'job' => 'SendCreatorPdfCatalogJob',
            'isVip' => $this->user->isVip(),
            'user' => $this->user->only(['id', 'name', 'email']),
            'creator' => $this->creator->only(['id', 'name']),
            'exception' => $exception->getMessage(),
        ], JSON_UNESCAPED_UNICODE));
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware(): array
    {
        return [new RateLimited(self::$onQueue)];
    }

    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
    public int $uniqueFor = 3600;

    /**
     * The unique ID of the job.
     *
     * @return string
     */
    public function uniqueId(): string
    {
        return "$this->user->id:$this->creator->id";
    }
}
