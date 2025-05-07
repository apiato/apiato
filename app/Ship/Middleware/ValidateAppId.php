<?php

namespace App\Ship\Middleware;

use App\Ship\Parents\Middleware\Middleware as ParentMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webmozart\Assert\Assert;

final class ValidateAppId extends ParentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, \Closure $next): mixed
    {
        $appId = $request->appId();
        Assert::keyExists(
            config()->array('apiato.apps'),
            $appId,
            "App-Identifier header value '{$appId}' is not valid. Allowed values are: " . implode(
                ', ',
                array_keys(config()->array('apiato.apps')),
            ),
        );

        return $next($request);
    }
}
