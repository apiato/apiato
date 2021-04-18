<?php

namespace App\Ship\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;

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
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        echo "Hello World :)\n";
    }
}
