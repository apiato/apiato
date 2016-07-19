<?php

namespace App\Containers\APIAuthentication\Middlewares;

use App\Containers\ApiAuthentication\Exceptions\AuthenticationFailedException;
use App\Containers\ApiAuthentication\Exceptions\MissingAgentIdException;
use App\Containers\User\Actions\CreateUserWithoutCredentialsAction;
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
     * @var  \App\Containers\User\Actions\CreateUserWithoutCredentialsAction
     */
    private $createUserWithoutCredentialsAction;

    /**
     * AgentAuthentication constructor.
     *
     * @param \Illuminate\Foundation\Application                              $app
     * @param \Jenssegers\Agent\Agent                                         $agent
     * @param \App\Containers\User\Actions\CreateUserWithoutCredentialsAction $createUserWithoutCredentialsAction
     */
    public function __construct(
        Application $app,
        Agent $agent,
        CreateUserWithoutCredentialsAction $createUserWithoutCredentialsAction
    ) {
        $this->app = $app;
        $this->agent = $agent;
        $this->createUserWithoutCredentialsAction = $createUserWithoutCredentialsAction;
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
        $token = $request->header('Authorization');

        if (!$token) {
            // read the agent ID header (set by the API users)
            $agentId = $request->header('Agent-Id');

            if (!$agentId) {
                throw new MissingAgentIdException();
            }

            $device = $this->agent->device();
            $platform = $this->agent->platform();

            $user = $this->createUserWithoutCredentialsAction->run($agentId, $device, $platform);

            if (!$user) {
                throw new AuthenticationFailedException(
                    'Something went wrong while trying to create user from the Agent ID: ' . $agentId
                );
            }
        }

        // return the response
        return $next($request);
    }
}
