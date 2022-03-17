<?php


namespace App\Services\Auth\Handlers;


use Illuminate\Auth\Events\Attempting;
use Illuminate\Support\Facades\Log;

class AttemptingEventHandler
{
    public function handle(Attempting $event): void
    {
        Log::info(json_encode($event));
    }

}
