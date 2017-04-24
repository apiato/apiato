<?php

namespace App\Ship\Parents\Requests;

use App;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Models\User;
use App\Ship\Engine\Traits\HashIdTrait;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

/**
 * Class Request
 *
 * A.K.A (app/Http/Requests/Request.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Request extends LaravelFormRequest
{

    use RequestTrait, HashIdTrait, StateKeeperTrait;

    /**
     * check if a user has permission to perform an action.
     * User can set multiple permissions (separated with "|") and if the user has
     * any of the permissions, he will be authorize to proceed with this action.
     *
     * @param \App\Containers\User\Models\User|null $user
     *
     * @return  bool
     */
    public function hasAccess(User $user = null)
    {
        // if not in parameters, take from the request object {$this}
        $user = $user ? : $this->user();

        $hasAccess = array_merge(
            $this->hasAnyPermissionAccess($user),
            $this->hasAnyRoleAccess($user)
        );

        // allow access if user has access to any of the defined roles or permissions.
        return empty($hasAccess) ? true : in_array(true, $hasAccess);
    }

    /**
     * Check if the submitted ID (mainly URL ID's) is the same as
     * the authenticated user ID (based on the user Token).
     *
     * @return  bool
     */
    public function isOwner()
    {
        return App::make(GetAuthenticatedUserTask::class)->run()->id == $this->id;
    }

    /**
     * To be used mainly from unit tests.
     *
     * @param array                                 $parameters
     * @param \App\Containers\User\Models\User|null $user
     * @param array                                 $cookies
     * @param array                                 $files
     * @param array                                 $server
     *
     * @return  static
     */
    public static function injectData($parameters = [], User $user = null, $cookies = [], $files = [], $server = [])
    {
        // if user is passed, will be returned when asking for the authenticated user using `\Auth::user()`
        if ($user) {
            $app = App::getInstance();
            $app['auth']->guard($driver = 'api')->setUser($user);
            $app['auth']->shouldUse($driver);
        }

        // For now doesn't matter which URI or Method is used.
        return parent::create('/', 'GET', $parameters, $cookies, $files, $server);
    }

}
