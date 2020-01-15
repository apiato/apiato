<?php

namespace Apiato\Core\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;
use File;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class ListActionsCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ListActionsCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "apiato:list:actions {--withfilename}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "List all Actions in the Application.";

    /**
     * ListActionsCommand constructor.
     *
     * @param \Symfony\Component\Console\Output\ConsoleOutput $console
     */
    public function __construct(ConsoleOutput $console)
    {
        parent::__construct();

        $this->console = $console;
    }

    /**
     * Handle the command
     */
    public function handle()
    {
        foreach (Apiato::getContainersNames() as $containerName) {

            $this->console->writeln("<fg=yellow> [$containerName]</fg=yellow>");

            $directory = base_path('app/Containers/' . $containerName . '/Actions');

            if (File::isDirectory($directory)) {

                $files = File::allFiles($directory);

                foreach ($files as $action) {

                    // get the file name as is
                    $fileName = $originalFileName = $action->getFilename();

                    // remove the Action.php postfix from each file name
                    $fileName = str_replace('Action.php', '', $fileName);

                    // further, remove the `.php', if the file does not end on 'Action.php'
                    $fileName = str_replace('.php', '', $fileName);

                    // uncamelize the word and replace it with spaces
                    $fileName = Apiato::uncamelize($fileName);

                    // check if flag exist
                    $includeFileName = '';
                    if ($this->option('withfilename')) {
                        $includeFileName = "<fg=red>($originalFileName)</fg=red>";
                    }

                    $this->console->writeln("<fg=green>  - $fileName</fg=green>  $includeFileName");
                }
            }
        }
    }

}
