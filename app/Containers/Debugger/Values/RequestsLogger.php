<?php

namespace App\Containers\Debugger\Values;

use App\Ship\Parents\Values\Value;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class RequestsLogger extends Value
{
    private const TESTING_ENV = 'testing';

    protected $debuggingEnabled;
    protected $environment;
    protected $logger;
    protected $logFile;

    public function __construct()
    {
        $this->prepareConfigs();
        $this->prepareLogger();
    }

    private function prepareConfigs(): void
    {
        $this->environment = App::environment();
        $this->debuggingEnabled = Config::get("debugger.requests.debug");
        $this->logFile = Config::get("debugger.requests.log_file");
    }

    private function prepareLogger(): void
    {
        $handler = new StreamHandler(storage_path('logs/' . $this->logFile));
        $handler->setFormatter(new LineFormatter(null, null, true, true));

        $this->logger = new Logger("REQUESTS DEBUGGER");
        $this->logger->pushHandler($handler);
    }

    public function releaseOutput(Output $output): void
    {
        if ($this->environment !== self::TESTING_ENV && $this->debuggingEnabled === true) {
            $this->logger->info($output->get());
        }
    }
}
