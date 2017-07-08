<?php

namespace App\Ship\Engine\Kernels;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as LaravelConsoleKernel;

/**
 * Class ShipConsoleKernel
 *
 * A.K.A (app/Console/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ShipConsoleKernel extends LaravelConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // You can register your command manually here, or just put your command class in the `app/Ship/Commands`
        // folder, and it will get auto-magically registered by the `app/Ship/Engine/Loaders/ConsolesLoaderTrait.php`.
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
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
