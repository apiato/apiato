<?php

namespace App\Ship\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webmozart\Assert\Assert;

final class ValidateAppId
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, \Closure $next): mixed
    {
        $appId = $request->header('App-Identifier', config('apiato.defaults.app'));
        Assert::keyExists(config('apiato.apps'), $appId, "App-Identifier header value '{$appId}' is not valid. Allowed values are: " . implode(', ', array_keys(config('apiato.apps'))));

        return $next($request);
    }
}
