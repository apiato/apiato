<?php

namespace App\Containers\Documentation\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;

class GenerateApiDocsCommand extends ConsoleCommand
{
    protected $signature = "apiato:apidoc";

    protected $description = "Generate API Documentations with (API-Doc-JS)";

    public function handle(): void
    {
        Apiato::call('Documentation@GenerateDocumentationAction', [$this]);
    }
}
