<?php

namespace App\Containers\Debugger\Middlewares;

use App\Containers\Debugger\Values\Output;
use App\Containers\Debugger\Values\RequestsLogger;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Http\Request;

class RequestsMonitorMiddleware extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $output = new Output($request, $response);

        $output->newRequest();
        $output->spaceLine();

        $output->addHeader("REQUEST INFO");
        $output->endpoint();
        $output->version();
        $output->ip();
        $output->format();
        $output->spaceLine();

        $output->addHeader("USER INFO");
        $output->userInfo();
        $output->spaceLine();

        $output->addHeader("REQUEST DATA");
        $output->requestData();
        $output->spaceLine();

        $output->addHeader("RESPONSE DATA");
        $output->responseData();
        $output->spaceLine();

        (new RequestsLogger())->releaseOutput($output);

        return $response;
    }
}
