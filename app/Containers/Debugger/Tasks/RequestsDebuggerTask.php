<?php

namespace App\Containers\Debugger\Tasks;

use App;
use DB;
use Illuminate\Support\Facades\Config;
use Jenssegers\Agent\Facades\Agent;
use Log;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class RequestsDebuggerTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RequestsDebuggerTask
{

    CONST TESTING_ENV = 'testing';

    protected $responseDataCut;

    protected $tokenDataCut;

    protected $debuggingEnabled;

    protected $environment;

    protected $logger;

    protected $logFile;

    /**
     * RequestsDebuggerTask constructor.
     */
    public function __construct()
    {
        $this->prepareConfigs();
        $this->prepareLogger();
    }

    /**
     * @param $request
     * @param $response
     */
    public function run($request, $response)
    {
        if ($this->environment != self::TESTING_ENV && $this->debuggingEnabled === true) {

            // Prepare some data to be displayed

            // Auth Header
            $authHeader = $request->header("Authorization");

            // User
            $user = $request->user() ? "ID: " . $request->user()->id . " (Name: " . $request->user()->name . ")" : "N/A";

            // Browser
            $browser = Agent::browser();

            // Request Data
            $requestData = $request->all() ? http_build_query($request->all(), "", " + ") : "N/A";

            // Response Data
            $responseContent = ($response && method_exists($response, "content")) ? $response->content() : "N/A";

            // Call the Logger.
            $this->log($request, $user, $browser, $authHeader, $responseContent, $requestData);
        }
    }

    /**
     * Feel free to pass any extra data to be displayed.
     *
     * @param $request
     * @param $user
     * @param $browser
     * @param $authHeader
     * @param $responseContent
     * @param $requestData
     */
    private function log($request, $user, $browser, $authHeader, $responseContent, $requestData)
    {
        $print = "----------------- NEW REQUEST ---------------------------------------------------";
        $print .= "\n \n";

        $print .= "REQUEST: \n";
        $print .= "   Endpoint: " . $request->fullUrl() . "\n";
        $print .= "   Method: " . $request->getMethod() . "\n";

        if(method_exists($request, 'version')){
            $print .= "   Version: " . $request->version() . "\n";
        }

        $print .= "   IP: " . $request->ip() . " (Port: " . $request->getPort() . ") \n";
        $print .= "   Format: " . $request->format() . "\n";
        $print .= "\n \n";

        $print .= "USER: \n";
        $print .= "   Access Token: " . substr($authHeader, 0, $this->tokenDataCut) . (!is_null($authHeader) ? "..." : "N/A") . "\n";
        $print .= "   User: " . $user . "\n";
        $print .= "   Device: " . Agent::device() . " (Platform: " . Agent::platform() . ") \n";
        $print .= "   Browser: " . $browser . " (Version: " . Agent::version($browser) . ") \n";
        $print .= "   Languages: " . implode(", ", Agent::languages()) . "\n";
        $print .= "\n \n";

        $print .= "REQUEST DATA: \n";
        $print .= "   " . $requestData . "\n";
        $print .= "\n \n";

        $print .= "RESPONSE DATA: \n";
        $print .= "   " . substr($responseContent, 0, $this->responseDataCut) . "..." . "\n";


        // ...
        // ......
        // ...


        // Log the String
        $this->logger->info($print);
    }

    /**
     * @void
     */
    private function prepareConfigs()
    {
        $this->environment = App::environment();

        $this->debuggingEnabled = Config::get("debugger.requests.debug");
        $this->logFile = Config::get("debugger.requests.log_file");
        $this->responseDataCut = Config::get("debugger.requests.response_show_first");
        $this->tokenDataCut = Config::get("debugger.requests.token_show_first");
    }

    /**
     * @void
     */
    private function prepareLogger()
    {
        $handler = new StreamHandler(storage_path('logs/' . $this->logFile));
        $handler->setFormatter(new LineFormatter(null, null, true, true));

        $this->logger = new Logger("REQUESTS DEBUGGER");
        $this->logger->pushHandler($handler, Logger::INFO);
    }

}
