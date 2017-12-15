<?php

namespace App\Ship\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;

/**
 * Class HelloWorldCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class HelloWorldCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hello:world';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hello World!';

    /**
     * Create a new command instance.
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
        echo "Hello World :)\n";
    }
}
