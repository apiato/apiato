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
use Illuminate\Support\Facades\App;

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
     * @throws \App\Containers\Application\Exceptions\UserNotPermittedException
     * @throws \App\Containers\Application\Exceptions\AuthenticationFailedException
     */
    public function handle($request, Closure $next)
    {
        // NOTE: this ApplicationAuthentication `app.auth` works on top of the `api.auth` provided by dingo.
        // Some endpoints can be accessed by 2 types of tokens (User & App). Laravel doesn't support
        // middleware fallback: (if not first middleware try the second): `'middleware' => ['app.auth|api.auth']`
        // So this middleware `app.auth` will be used on the endpoints that are allowed to be accessed by Apps.
        // It check first if the token contain Application ID in its payload and if so it tries to authenticate
        // the (owner) user of that App. BUT if the token doesn't have an Application ID that means he is using
        // his own token from my client App (Admin/User front-end) so will try to authenticate him normally
        // using the `api.auth` (this is the fallback to the original auth middleware).

        $token = str_replace('Bearer ', '', $request->header('authorization'));

        if(!$token){
            throw new AuthenticationFailedException('Empty Token!');
        }

        // get App ID from the token payload custom claim `ApplicationId`
        if ($applicationId = $this->jwtAuthAdapter->getPayload($token)->get('ApplicationId')) {

            // find that App in the database
            $application = $this->findApplicationByIdTask->run($applicationId);

            if (!$application || !$user = $application->store->user) {
                throw new AuthenticationFailedException();
            }

            // add the application on the request object
            $request->merge([
                'application' => $application
            ]);

            // NOTE: You can remove this condition of you are not using roles for this purpose.
            // Allow Access only for users with valid developer account
            if (!$user->hasRole('developer')) {
                throw new UserNotPermittedException();
            }

        }else{
            return (App::make(\Dingo\Api\Http\Middleware\Auth::class))->handle($request, $next);
            // another way to do handle this is by calling `$user = $this->jwtAuthAdapter->toUser($token);`
            // and continuing the execution of this code till the last return, but to maintain consistency
            // I'm calling the same auth middleware used by all other endpoints.
        }

        // make the user accessible on the requests objects when using `$request->user()`
        $this->authManager->setUser($user);

        return $next($request);
    }

}
