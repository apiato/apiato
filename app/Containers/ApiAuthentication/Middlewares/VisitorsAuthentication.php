<?php

namespace App\Containers\APIAuthentication\Middlewares;

use App\Containers\ApiAuthentication\Exceptions\AuthenticationFailedException;
use App\Containers\ApiAuthentication\Exceptions\MissingVisitorIdException;
use App\Containers\User\Actions\RegisterVisitorUserAction;
use Closure;
use Illuminate\Foundation\Application;
use Jenssegers\Agent\Agent;

/**
 * Class VisitorsAuthentication
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class VisitorsAuthentication
{

    /**
     * @var  \Jenssegers\Agent\Agent
     */
    private $agent;

    /**
     * @var  \Illuminate\Foundation\Application
     */
    private $app;

    /**
     * @var  \App\Containers\User\Actions\RegisterVisitorUserAction
     */
    private $registerVisitorUserAction;

    /**
     * VisitorsAuthentication constructor.
     *
     * @param \Illuminate\Foundation\Application                     $app
     * @param \Jenssegers\Agent\Agent                                $agent
     * @param \App\Containers\User\Actions\RegisterVisitorUserAction $registerVisitorUserAction
     */
    public function __construct(
        Application $app,
        Agent $agent,
        RegisterVisitorUserAction $registerVisitorUserAction
    ) {
        $this->app = $app;
        $this->agent = $agent;
        $this->registerVisitorUserAction = $registerVisitorUserAction;
    }


    /**
     * Whenever the request doesn't have an Authorization header (token)
     * it must have a an Visitor-Id header.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            // read the visitor ID header (set by the API users)
            $visitorId = $request->header('Visitor-Id');

            if (!$visitorId) {
                throw new MissingVisitorIdException();
            }

            $device = $this->agent->device();
            $platform = $this->agent->platform();

            $user = $this->registerVisitorUserAction->run($visitorId, $device, $platform);

            if (!$user) {
                throw new AuthenticationFailedException(
                    'Something went wrong while trying to create user from the Visitor ID: ' . $visitorId
                );
            }
        }

        // return the response
        return $next($request);
    }
}
