<?php

namespace App\Containers\Welcome\UI\CLI\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;

/**
 * Class SayWelcome
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SayWelcome extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiato:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just saying Welcome.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        echo "Welcome to apiato :)\n";
    }
}
