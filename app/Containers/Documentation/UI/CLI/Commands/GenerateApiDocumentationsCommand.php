<?php

namespace App\Containers\Documentation\UI\CLI\Commands;

use App\Containers\Documentation\Actions\GenerateAPIDocsAction;
use App\Containers\Documentation\Objects\PublicApi;
use App\Containers\Documentation\Objects\PrivateApi;
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
     * @param \App\Containers\Documentation\Actions\GenerateAPIDocsAction $action
     */
    public function handle(GenerateAPIDocsAction $action)
    {
        // TODO: add optional argument array, allowing user to specify a type or more otherwise take all

        $types = [
            PrivateApi::TYPE,
            PublicApi::TYPE,
        ];

        echo "Generating API Documentations " . implode('& ', $types) . ".\n";

        foreach ($types as $type) {
            $documentationUrls[] = "[ {your-domain}/{$action->run($type)} ]";
        }

        echo "Done! You can access your API Docs at: " . implode(' & ', $documentationUrls) . ".\n";
    }
}
