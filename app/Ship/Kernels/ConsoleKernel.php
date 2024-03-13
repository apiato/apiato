<?php

namespace App\Ship\Kernels;

use Illuminate\Console\Scheduling\Schedule;
use App\Ship\Parents\Commands\ConsoleCommand;
use Illuminate\Console\Application as Artisan;
use Illuminate\Foundation\Console\Kernel as LaravelConsoleKernel;

class ConsoleKernel extends LaravelConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // NOTE: your Containers command will all be auto registered for you.
        // Same for the Ship commands who live in the `app/Ship/Commands/` directory.
        // If you have commands living somewhere else then consider registering them manually here.
    ];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // NOTE: No need to load your Commands manually from here.
        // As they are automatically registered by the Apiato Loader.

        // $this->load(__DIR__.'/Commands');

        //Autoload schedule from Command method
        Artisan::starting(
            function ($artisan) {
                collect($artisan->all())->each(
                    function ($command) use ($artisan) {
                        $command->setApplication($artisan);
                        if ($command instanceof ConsoleCommand && method_exists($command, 'schedule')) {
                            $this->app->call([$command, 'schedule']);
                        }
                    }
                );
            }
        );
        
        require app_path('Ship/Commands/closures.php');
    }
}
