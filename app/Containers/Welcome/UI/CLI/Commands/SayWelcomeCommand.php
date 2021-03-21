<?php

namespace App\Containers\Welcome\UI\CLI\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;

class SayWelcomeCommand extends ConsoleCommand
{
    protected $signature = 'apiato:welcome';

    protected $description = 'Just saying welcome from a container.';

    public function handle(): void
    {
        echo "Welcome to Apiato :)\n";
    }
}
