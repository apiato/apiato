<?php

namespace App\Containers\Welcome\UI\CLI\Commands;

use App\Port\Console\Abstracts\ConsoleCommand;

/**
 * Class SayWelcome
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SayWelcome extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'say:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just Saying Welcome.';

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
        echo "Welcome to Hello API :)\n";
    }
}
