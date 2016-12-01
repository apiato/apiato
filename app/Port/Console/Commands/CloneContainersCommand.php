<?php
//
//namespace App\Port\Console\Commands;
//
//use App\Port\Console\Abstracts\ConsoleCommand;
//use Symfony\Component\Process\Exception\ProcessFailedException;
//use Symfony\Component\Process\Process;
//
///**
// * Class CloneContainersCommand
// *
// * @author  Mahmoud Zalt  <mahmoud@zalt.me>
// */
//class CloneContainersCommand extends ConsoleCommand
//{
//
//    /**
//     * The name and signature of the console command.
//     *
//     * @var string
//     */
//    protected $signature = "containers:add {repository-names*}"; // {--skip-update=false}
//
//    /**
//     * The console command description.
//     *
//     * @var string
//     */
//    protected $description = "select existing container to download";
//
//    /**
//     * Create a new command instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        parent::__construct();
//    }
//
//    /**
//     * Execute the console command.
//     *
//     * @return mixed
//     */
//    public function handle()
//    {
//        $ContainersPath = "app/Containers";
//
//        foreach ($this->argument("repository-names") as $repoName) {
//            $repoName = ucfirst(strtolower($repoName));
//
//            // TODO: find a way to validate the repo!
//            $process1 = new Process("git clone https://github.com/Porto-SAP/" . $repoName . ".git " . $ContainersPath . "/" . $repoName);
//            $process1->run();
//
//            if (!$process1->isSuccessful()) {
//                throw new ProcessFailedException($process1);
//            }
//
//            echo "Downloading " . $repoName . " completed successfully.\n";
//        }
//
//        // TODO: add skip update option
//
////        if (!$this->option('skip-update')) {
//
//            echo "Running 'Composer Update'..\n";
//            $process2 = new Process("composer update");
//            $process2->setTimeout(300);
//            $process2->run();
//
//            if (!$process2->isSuccessful()) {
//                throw new ProcessFailedException($process2);
//            }
//
//            echo $process2->getOutput();
////        }
//
//        echo "Congratulation :)\n";
//    }
//}
