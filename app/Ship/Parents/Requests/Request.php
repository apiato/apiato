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

    /**
     * Sanitizes the data of a request. This is a superior version of php built-in array_filter() as it preserves
     * FALSE and NULL values as well.
     *
     * @param array $fields a list of fields to be checked in the Dot-Notation (e.g., ['data.name', 'data.description'])
     * @return array an array containing the values if the field was present in the request and the intersection array
     */
    public function sanitizeInput(array $fields)
    {
        // get all request data
        $data = $this->all();

        $search = [];
        foreach($fields as $field) {
            // create a multidimensional array based on $fields
            // which was submitted as DOT notation (e.g., data.name)
            array_set($search, $field, true);
        }

        // check, if the keys exist in both arrays
        $data = $this->recursive_array_intersect_key(
            $data,
            $search
        );

        return $data;
    }

    /**
     * Recursively intersects 2 arrays based on their keys.
     *
     * @param array $a first array (that keeps the values)
     * @param array $b second array to be compared with
     * @return array an array containing all keys that are present in $a and $b. Only values from $a are returned
     */
    private function recursive_array_intersect_key(array $a, array $b) {
        $a = array_intersect_key($a, $b);
        foreach ($a as $key => &$value) {
            if (is_array($value) && is_array($b[$key])) {
                $value = $this->recursive_array_intersect_key($value, $b[$key]);
            }
        }
        return $a;
    }

}
