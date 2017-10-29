<?php

namespace App\Containers\Debugger\ValueObjects;

use App\Ship\Parents\ValueObjects\ValueObject;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Log;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class RequestsLogger
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RequestsLogger extends ValueObject
{

    CONST TESTING_ENV = 'testing';

    protected $debuggingEnabled;

    protected $environment;

    protected $logger;

    protected $logFile;

    /**
     * RequestsLogger constructor.
     */
    public function __construct()
    {
        $this->prepareConfigs();
        $this->prepareLogger();
    }

    /**
     * @param \App\Containers\Debugger\ValueObjects\Output $output
     */
    public function releaseOutput(Output $output)
    {
        if ($this->environment != self::TESTING_ENV && $this->debuggingEnabled === true) {
            $this->logger->info($output->get());
        }
    }

    /**
     * @void
     */
    private function prepareConfigs()
    {
        $this->environment = App::environment();
        $this->debuggingEnabled = Config::get("debugger.requests.debug");
        $this->logFile = Config::get("debugger.requests.log_file");
    }

    /**
     * @void
     */
    private function prepareLogger()
    {
        $handler = new StreamHandler(storage_path('logs/' . $this->logFile));
        $handler->setFormatter(new LineFormatter(null, null, true, true));

        $this->logger = new Logger("REQUESTS DEBUGGER");
        $this->logger->pushHandler($handler);
    }
}
