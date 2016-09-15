<?php

namespace App\Containers\Authentication\Middlewares;

use App\Containers\Authentication\Exceptions\MissingVisitorIdException;
use App\Containers\User\Tasks\FindUserByVisitorIdTask;
use Closure;
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
     * VisitorsAuthentication constructor.
     *
     * @param \App\Containers\User\Tasks\FindUserByVisitorIdTask $findUserByVisitorIdTask
     */
    public function __construct(
        FindUserByVisitorIdTask $findUserByVisitorIdTask
    ) {
        $this->findUserByVisitorIdTask = $findUserByVisitorIdTask;
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

        $user = $this->findUserByVisitorIdTask->run($visitorId);

        if (!$user) {
            abort(403);
        }

        // return the response
        return $next($request);
    }
}
