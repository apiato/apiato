<?php

namespace App\Containers\Authentication\Middlewares;

use App\Containers\Authentication\Exceptions\MissingVisitorIdException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

/**
 * Class VisitorsAuthentication
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class VisitorsAuthentication
{

    /**
     * @var  \App\Containers\User\Tasks\FindUserByVisitorIdTask
     */
    private $findUserByVisitorIdTask;

    /**
     * @var  \App\Containers\Authentication\Middlewares\AuthManager|\Illuminate\Auth\AuthManager
     */
    private $authManager;

    /**
     * VisitorsAuthentication constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask $findUserByVisitorIdTask
     * @param \Illuminate\Auth\AuthManager                       $authManager
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask,
        AuthManager $authManager
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
        $this->authManager = $authManager;
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // read the visitor ID header (set by the API users)
        $visitorId = $request->header('visitor-id');

        if (!$visitorId) {
            throw new MissingVisitorIdException();
        }

        // If I use "$this->findUserByVisitorIdTask->run($visitorId)" it applies any query parameters passed
        // with the request to the search for user function, and this cause problems like (user not found)
        // especially when passing something like `&search=name:whatever` it applies this on the user before
        // reaching its final repository.
        $user = User::where('visitor_id', $visitorId)->first();

        if (!$user) {
            abort(403);
        }

        // make the user accessible outside the middleware (\Auth::user())
        $this->authManager->setUser($user);

        $response = $next($request);

        // make sure nothing left from that user, after this request end
        $this->authManager->logout();

        return $response;
    }
}
