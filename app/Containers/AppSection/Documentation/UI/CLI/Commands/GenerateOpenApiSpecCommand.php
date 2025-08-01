<?php

namespace App\Containers\AppSection\Documentation\UI\CLI\Commands;

use Apiato\Core\Console\Command as AbstractConsoleCommand;
use App\Containers\AppSection\Documentation\Actions\GenerateOpenApiDocumentationAction;

class GenerateOpenApiSpecCommand extends AbstractConsoleCommand
{
    protected $signature = 'apiato:openapi';
    protected $description = 'Generate OpenAPI specification';

    final public function handle(): void
    {
        app(GenerateOpenApiDocumentationAction::class)->run($this);
    }
}
