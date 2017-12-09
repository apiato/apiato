<?php

namespace App\Containers\Debugger\Values;

use App\Ship\Parents\Values\Value;
use Illuminate\Support\Facades\Config;
use Jenssegers\Agent\Facades\Agent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Output
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Output extends Value
{

    /**
     * @var  string
     */
    public $output = '';

    /**
     * @var
     */
    private $request;

    /**
     * @var
     */
    private $response;

    /**
     * @var
     */
    protected $responseDataCut;

    /**
     * @var
     */
    protected $tokenDataCut;

    /**
     * Output constructor.
     *
     * @param \Symfony\Component\HttpFoundation\Request  $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->responseDataCut = Config::get("debugger.requests.response_show_first");
        $this->tokenDataCut = Config::get("debugger.requests.token_show_first");
    }

    /**
     * @param $text
     *
     * @return  string
     */
    protected function set($text)
    {
        return $this->output = $text;
    }

    /**
     * @return  string
     */
    public function get()
    {
        return $this->output;
    }

    /**
     * @void
     */
    public function clear()
    {
        $this->set('');
    }

    /**
     * Add header
     *
     * @param $name
     */
    public function header($name)
    {
        $this->append("$name: \n");
    }

    /**
     * Add line to indicate new request
     *
     * @void
     */
    public function newRequest()
    {
        $this->append("----------------- NEW REQUEST -----------------");
    }

    /**
     * Add empty line
     *
     * @void
     */
    public function spaceLine()
    {
        $this->append("\n \n");
    }

    /**
     * @void
     */
    public function endpoint()
    {
        $this->append(" * Endpoint: " . $this->request->fullUrl() . "\n");
        $this->append(" * Method: " . $this->request->getMethod() . "\n");
    }

    /**
     * @void
     */
    public function version()
    {
        if (method_exists($this->request, 'version')) {
            $this->append(" * Version: " . $this->request->version() . "\n");
        }
    }

    /**
     * @void
     */
    public function ip()
    {
        $this->append(" * IP: " . $this->request->ip() . " (Port: " . $this->request->getPort() . ") \n");
    }

    /**
     * @void
     */
    public function format()
    {
        $this->append(" * Format: " . $this->request->format() . "\n");
    }

    /**
     * @void
     */
    public function userInfo()
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

    /**
     * @void
     */
    public function requestData()
    {
        // Request Data
        $requestData = $this->request->all() ? http_build_query($this->request->all(), "", " + ") : "N/A";

        $this->append(" * " . $requestData . "\n");
    }

    /**
     * @void
     */
    public function responseData()
    {
        // Response Data
        $responseContent = ($this->response && method_exists($this->response,
                "content")) ? $this->response->content() : "N/A";

        $this->append(" * " . substr($responseContent, 0, $this->responseDataCut) . "..." . "\n");
    }

    /**
     * @param $output
     *
     * @return  string
     */
    private function append($output)
    {
        return $this->output .= $output;
    }

}
