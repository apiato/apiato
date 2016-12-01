<?php

namespace App\Containers\Application\Middlewares;

use App\Containers\Application\Exceptions\AuthenticationFailedException;
use App\Containers\Application\Exceptions\UserNotPermittedException;
use App\Containers\Application\Tasks\FindApplicationByIdTask;
use App\Containers\Authentication\Adapters\JwtAuthAdapter;
use Closure;
use Dingo\Api\Auth\Auth as Authentication;
use Dingo\Api\Routing\Router;
use Illuminate\Auth\AuthManager;

/**
 * Class ApplicationAuthentication
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ApplicationAuthentication
{

    /**
     * Router instance.
     *
     * @var \Dingo\Api\Routing\Router
     */
    protected $router;

    /**
     * Authenticator instance.
     *
     * @var \Dingo\Api\Auth\Auth
     */
    protected $auth;

    /**
     * @var  \App\Containers\Application\Tasks\FindApplicationByIdTask
     */
    private $findApplicationByIdTask;

    /**
     * @var  \App\Containers\Authentication\Adapters\JwtAuthAdapter
     */
    private $jwtAuthAdapter;

    /**
     * @var  \Illuminate\Auth\AuthManager
     */
    private $authManager;

    /**
     * ApplicationAuthentication constructor.
     *
     * @param \Dingo\Api\Routing\Router                                 $router
     * @param \Dingo\Api\Auth\Auth                                      $auth
     * @param \App\Containers\Application\Tasks\FindApplicationByIdTask $findApplicationByIdTask
     * @param \App\Containers\Authentication\Adapters\JwtAuthAdapter    $jwtAuthAdapter
     * @param \Illuminate\Auth\AuthManager                              $authManager
     */
    public function __construct(
        Router $router,
        Authentication $auth,
        FindApplicationByIdTask $findApplicationByIdTask,
        JwtAuthAdapter $jwtAuthAdapter,
        AuthManager $authManager
    ) {
        $this->router = $router;
        $this->auth = $auth;
        $this->findApplicationByIdTask = $findApplicationByIdTask;
        $this->jwtAuthAdapter = $jwtAuthAdapter;
        $this->authManager = $authManager;
    }

    /**
     * @param          $request
     * @param \Closure $next
     *
     * @return  mixed
     */
    public function handle($request, Closure $next)
    {
        $token = str_replace('Bearer ', '', $request->header('authorization'));

        $user = $this->jwtAuthAdapter->toUser($token);

        // NOTE: You can remove this condition of you are not using roles for this purpose.
        // check if the user has developer role, in case accessing an endpoint from his own user account instead of App
        // prevent his access unless he is an approved developer.
        if (!$user || !$user->hasRole('developer')) {
            throw new UserNotPermittedException();
        }

        $request->user = $user;

        // get App ID from the token payload custom claim `ApplicationId`
        if ($applicationId = $this->jwtAuthAdapter->getPayload($token)->get('ApplicationId')) {

            // find that App in the database
            $application = $this->findApplicationByIdTask->run($applicationId);

            // also validate the owner of that App is the same making this request and using the token
            if (!$application || ($application->user->id != $user->id)) {
                throw new AuthenticationFailedException();
            }
        }

        // make the user accessible on the requests objects when using `$request->user()`
        $this->authManager->setUser($user);

        return $next($request);
    }

}
