<?php

namespace App\Containers\Documentation\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;
use App\Ship\Transporters\DataTransporter;

class GenerateSwaggerCommand extends ConsoleCommand
{
    protected $signature = "apiato:swagger";

    protected $description = "Generate API Documentations with (Swagger from API-Doc-JS)";

    public function handle(): void
    {
        $transporter = new DataTransporter();
        $transporter->setInstance("command_instance", $this);

        Apiato::call('Documentation@GenerateSwaggerAction', [$transporter]);
    }
}
