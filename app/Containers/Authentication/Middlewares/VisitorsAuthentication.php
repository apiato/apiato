<?php

namespace App\Containers\Authentication\Middlewares;

use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Containers\Authentication\Exceptions\MissingVisitorIdException;
use App\Containers\User\Actions\CreateVisitorUserAction;
use Closure;
use Illuminate\Http\Request;
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
     * @var  \App\Containers\User\Actions\CreateVisitorUserAction
     */
    private $registerVisitorUserAction;

    /**
     * VisitorsAuthentication constructor.
     *
     * @param \Jenssegers\Agent\Agent                                $agent
     * @param \App\Containers\User\Actions\CreateVisitorUserAction $registerVisitorUserAction
     */
    public function __construct(
        Agent $agent,
        CreateVisitorUserAction $registerVisitorUserAction
    ) {
        $this->agent = $agent;
        $this->registerVisitorUserAction = $registerVisitorUserAction;
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token || strlen($token) < 20) {
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
                    'Something went wrong while trying to create user from the "Visitor-Id": ' . $visitorId
                );
            }
        }

        // return the response
        return $next($request);
    }
}
