<?php

namespace App\Console;

use App\Console\Commands\CachePrepare;
use App\Console\Commands\CacheRatings;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            Log::debug('First User Name = ' . User::first()->name);
        })->everyTwoHours();

        $schedule->command(CachePrepare::class)
            ->withoutOverlapping()
            ->hourly();

        $schedule->command(CacheRatings::class)
            ->timezone('Europe/Moscow')
            ->onOneServer()
            ->runInBackground()
            ->everyTwoHours()
            ->between('10:00', '20:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
