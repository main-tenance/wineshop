<?php


namespace App\Services\Auth\Handlers;


use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Log;

class AuthenticatedEventHandler
{
    public function handle(Authenticated $event): void
    {
        Log::info(json_encode($event));
    }

}
