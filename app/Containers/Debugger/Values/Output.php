<?php

namespace App\Containers\Debugger\Values;

use App\Ship\Parents\Values\Value;
use Illuminate\Support\Facades\Config;
use Jenssegers\Agent\Facades\Agent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Output extends Value
{
    public string $output = '';
    protected $responseDataCut;
    protected $tokenDataCut;
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->responseDataCut = Config::get("debugger.requests.response_show_first");
        $this->tokenDataCut = Config::get("debugger.requests.token_show_first");
    }

    public function get(): string
    {
        return $this->output;
    }

    public function clear(): void
    {
        $this->set('');
    }

    protected function set($text): string
    {
        return $this->output = $text;
    }

    public function addHeader(string $name): void
    {
        $this->append("$name: \n");
    }

    private function append($output): string
    {
        return $this->output .= $output;
    }

    public function newRequest(): void
    {
        $this->append("----------------- NEW REQUEST -----------------");
    }

    public function spaceLine(): void
    {
        $this->append("\n \n");
    }

    public function endpoint(): void
    {
        $this->append(" * Endpoint: " . $this->request->fullUrl() . "\n");
        $this->append(" * Method: " . $this->request->getMethod() . "\n");
    }

    public function version(): void
    {
        if (method_exists($this->request, 'version')) {
            $this->append(" * Version: " . $this->request->version() . "\n");
        }
    }

    public function ip(): void
    {
        $this->append(" * IP: " . $this->request->ip() . " (Port: " . $this->request->getPort() . ") \n");
    }

    public function format(): void
    {
        $this->append(" * Format: " . $this->request->format() . "\n");
    }

    public function userInfo(): void
    {
        // Auth Header
        $authHeader = $this->request->header("Authorization");
        // User
        $user = $this->request->user() ? "ID: " . $this->request->user()->id . " (Name: " . $this->request->user()->name . ")" : "N/A";
        // Browser
        $browser = Agent::browser();

        $this->append(" * Access Token: " . substr($authHeader, 0,
                $this->tokenDataCut) . (!is_null($authHeader) ? "..." : "N/A") . "\n");
        $this->append(" * User: " . $user . "\n");
        $this->append(" * Device: " . Agent::device() . " (Platform: " . Agent::platform() . ") \n");
        $this->append(" * Browser: " . $browser . " (Version: " . Agent::version($browser) . ") \n");
        $this->append(" * Languages: " . implode(", ", Agent::languages()) . "\n");
    }

    public function requestData(): void
    {
        // Request Data
        $requestData = $this->request->all() ? http_build_query($this->request->all(), "", " + ") : "N/A";

        $this->append(" * " . $requestData . "\n");
    }

    public function responseData(): void
    {
        // Response Data
        $responseContent = ($this->response && method_exists($this->response,
                "content")) ? $this->response->content() : "N/A";

        $this->append(" * " . substr($responseContent, 0, $this->responseDataCut) . "..." . "\n");
    }
}
