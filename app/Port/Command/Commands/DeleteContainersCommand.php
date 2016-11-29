<?php

namespace App\Port\Command\Commands;

use App\Port\Console\Abstracts\ConsoleCommand;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class DeleteContainersCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteContainersCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "containers:remove {container-names*}"; // {--skip-update=false}

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "select existing container to download";

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ContainersPath = "app/Containers";

        foreach ($this->argument("container-names") as $repoName) {
            $repoName = ucfirst(strtolower($repoName));

            // TODO: find a way to validate the repo!
            $process = new Process("rm -rf " . $ContainersPath . '/' .$repoName);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            echo "Container " . $repoName . " deleted successfully.\n";
        }

        // TODO: add skip update option

//        if (!$this->option('skip-update')) {

            echo "Running 'Composer Update'..\n";
            $process = new Process("composer update");
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            echo $process->getOutput();
//        }

        echo "Congratulation :)\n";
    }
}
