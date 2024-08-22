<?php

namespace App\Ship\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;

class HelloWorldCommand extends ConsoleCommand
{
    protected $signature = 'hello:world';
    protected $description = 'Says Hello World!';

    public function handle(): void
    {
        $this->line('Hello World!');
    }
}
