<?php

namespace App\Containers\Documentation\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;

class GenerateSwaggerCommand extends ConsoleCommand
{
    protected $signature = "apiato:swagger";

    protected $description = "Generate API Documentations with (Swagger from API-Doc-JS)";

    public function handle(): void
    {
        Apiato::call('Documentation@GenerateSwaggerAction', [$this]);
    }
}
