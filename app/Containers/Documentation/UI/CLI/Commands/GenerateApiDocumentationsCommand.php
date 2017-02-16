<?php

namespace App\Containers\Documentation\UI\CLI\Commands;

use App\Containers\Documentation\Actions\GenerateAPIDocsAction;
use App\Containers\Documentation\Actions\ProcessMarkdownTemplatesAction;
use App\Containers\Documentation\Objects\PrivateApi;
use App\Containers\Documentation\Objects\PublicApi;
use App\Port\Console\Abstracts\ConsoleCommand;

/**
 * Class GenerateApiDocumentationsCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GenerateApiDocumentationsCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "apidoc:generate";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate API Documentations (using API Doc JS)";

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
     * @param \App\Containers\Documentation\Actions\ProcessMarkdownTemplatesAction $processMarkdownTemplatesAction
     * @param \App\Containers\Documentation\Actions\GenerateAPIDocsAction          $generateAPIDocsAction
     */
    public function handle(
        ProcessMarkdownTemplatesAction $processMarkdownTemplatesAction,
        GenerateAPIDocsAction $generateAPIDocsAction
    ) {
        // TODO: add optional argument array, allowing user to specify a type or more otherwise take all

        // parse the markdown file.
        $processMarkdownTemplatesAction->run();

        $types = [
            PrivateApi::$type,
            PublicApi::$type,
        ];

        echo "Generating API Documentations " . implode(' & ', $types) . ".\n";

        foreach ($types as $type) {
            $documentationUrls[] = "> {your-domain}/{$generateAPIDocsAction->run($type)}";
        }

        echo "Done! You can access your API Docs at: \n" . implode("\n", $documentationUrls) . "\n";
    }
}
