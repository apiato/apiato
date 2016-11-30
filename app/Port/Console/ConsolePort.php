<?php

namespace App\Port\Console;


//use App\Containers\Welcome\UI\CLI\Commands\SayWelcome;
use App\Port\Console\Commands\CloneContainersCommand;
use App\Port\Console\Commands\DeleteContainersCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as LaravelConsoleKernel;

/**
 * Class ConsolePort
 *
 * A.K.A (app/Console/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ConsolePort extends LaravelConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
//        SayWelcome::class,
        CloneContainersCommand::class,
        DeleteContainersCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
//        require base_path('routes/console.php');
    }
}
