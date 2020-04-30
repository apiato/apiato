<?php

namespace App\Containers\Documentation\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GenerateSwaggerCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GenerateSwaggerCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "apiato:swagger";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate API Documentations with (Swagger from API-Doc-JS)";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $transporter = new DataTransporter();
        $transporter->setInstance("command_instance", $this);

        Apiato::call('Documentation@GenerateSwaggerAction', [$transporter]);
    }

}
