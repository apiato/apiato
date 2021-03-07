<?php

namespace App\Ship\Middlewares\Http;

use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

class ProcessETagHeadersMiddleware extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        /*
         * This middleware will add the "ETag" HTTP Header to a Response. The ETag, in turn, is a
         * hash of the content that will be returned. The client may request an endpoint and provide an ETag in the
         * "If-None-Match" HTTP Header. If the calculated ETag and submitted ETag matches, the response is manipulated accordingly:
         * - the HTTP Status Code is set to 304 (not modified)
         * - the body content (i.e., the content that was supposed to be delivered) is removed --> the client receives an empty body
         */

        // the feature is disabled - so skip everything
        if (!config('apiato.requests.use-etag', false)) {
            return $next($request);
        }

        // check, if an "if-none-match" header is supplied
        if ($request->hasHeader('if-none-match')) {
            // check, if the request method is GET or HEAD
            if (!($request->method() === 'GET' || $request->method() === 'HEAD')) {
                throw new PreconditionFailedHttpException('HTTP Header IF-None-Match is only allowed for GET and HEAD Requests.');
            }
        }

        // everything is fine, just call the next middleware. We will process the ETag later on..
        $response = $next($request);

        // now we have processed the request and have a response that is sent back to the client.
        // calculate the etag of the content!
        $content = $response->getContent();
        $etag = md5($content);
        $response->headers->set('Etag', $etag);

        // now, lets check, if the request contains a "if-none-match" http header field
        if ($request->hasHeader('if-none-match')) {
            // now check, if the if-none-match etag is the same as the calculated etag!
            if ($request->header('if-none-match') === $etag) {
                $response->setStatusCode(304);
            }
        }

        return $response;
    }
}
