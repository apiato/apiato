<?php

namespace App\Containers\APIAuthentication\Middlewares;

use App\Containers\ApiAuthentication\Exceptions\AuthenticationFailedException;
use App\Containers\ApiAuthentication\Exceptions\MissingAgentIdException;
use App\Containers\User\Actions\RegisterAgentUserAction;
use Closure;
use Illuminate\Foundation\Application;
use Jenssegers\Agent\Agent;

/**
 * Class AgentAuthentication
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AgentAuthentication
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
     * @var  \App\Containers\User\Actions\RegisterAgentUserAction
     */
    private $RegisterAgentUserAction;

    /**
     * AgentAuthentication constructor.
     *
     * @param \Illuminate\Foundation\Application                   $app
     * @param \Jenssegers\Agent\Agent                              $agent
     * @param \App\Containers\User\Actions\RegisterAgentUserAction $RegisterAgentUserAction
     */
    public function __construct(
        Application $app,
        Agent $agent,
        RegisterAgentUserAction $RegisterAgentUserAction
    ) {
        $this->app = $app;
        $this->agent = $agent;
        $this->RegisterAgentUserAction = $RegisterAgentUserAction;
    }


    /**
     * Whenever the request doesn't have an Authorization header (token)
     * it must have a an Agent-Id header.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->agent->isMobile() || $this->agent->isPhone() || $this->agent->isTablet()) {

            $token = $request->header('Authorization');

            if (!$token) {
                // read the agent ID header (set by the API users)
                $agentId = $request->header('Agent-Id');

                if (!$agentId) {
                    throw new MissingAgentIdException();
                }

                $device = $this->agent->device();
                $platform = $this->agent->platform();

                $user = $this->RegisterAgentUserAction->run($agentId, $device, $platform);

                if (!$user) {
                    throw new AuthenticationFailedException(
                        'Something went wrong while trying to create user from the Agent ID: ' . $agentId
                    );
                }
            }
        }

        // return the response
        return $next($request);
    }
}
