<?php

namespace App\Ship\Parents\Requests;

use App\Ship\Features\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Dingo\Api\Http\Request as DingoRequest;

/**
 * Class RequestTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait RequestTrait
{

    /**
     * Overriding this function to modify the any user input before
     * applying the validation rules.
     *
     * @return  array
     */
    public function all()
    {
        $requestData = parent::all();

        $requestData = $this->mergeUrlParametersWithRequestData($requestData);

        $requestData = $this->decodeHashedIdsBeforeValidation($requestData);

        return $requestData;
    }

    /**
     * Overriding this function to throw a custom
     * exception instead of the default Laravel exception.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return mixed|void
     */
    public function failedValidation(Validator $validator)
    {
        if ($this->container['request'] instanceof DingoRequest) {
            throw new ValidationFailedException($validator->getMessageBag());
        }

        parent::failedValidation($validator);
    }


    /**
     * Used from the `authorize` function if the Request class.
     * To call functions and compare their bool responses to determine
     * if the user can proceed with the request or not.
     *
     * @param array $functions
     *
     * @return  bool
     */
    protected function check(array $functions)
    {
        $orIndicator = '|';
        $returns = [];

        // iterate all functions in the array
        foreach ($functions as $function) {

            // in case the value doesn't contains a separator (single function per key)
            if (!strpos($function, $orIndicator)) {
                // simply call the single function and store the response.
                $returns[] = $this->{$function}();
            } else {
                // in case the value contains a separator (multiple functions per key)
                $orReturns = [];

                // iterate over each function in the key
                foreach (explode($orIndicator, $function) as $orFunction) {
                    // dynamically call each function
                    $orReturns[] = $this->{$orFunction}();
                }

                // if in_array returned `true` means at least one function returned `true` thus return `true` to allow access.
                // if in_array returned `false` means no function returned `true` thus return `false` to prevent access.
                // return single boolean for all the functions found inside the same key.
                $returns[] = in_array(true, $orReturns) ? true : false;
            }
        }

        // if in_array returned `true` means a function returned `false` thus return `false` to prevent access.
        // if in_array returned `false` means all functions returned `true` thus return `true` to allow access.
        // return the final boolean
        return in_array(false, $returns) ? false : true;
    }

    /**
     * apply validation rules to the ID's in the URL, since Laravel
     * doesn't validate them by default!
     *
     * Now you can use validation riles like this: `'id' => 'required|integer|exists:items,id'`
     *
     * @param array $requestData
     *
     * @return  array
     */
    private function mergeUrlParametersWithRequestData(Array $requestData)
    {
        if (isset($this->urlParameters) && !empty($this->urlParameters)) {
            foreach ($this->urlParameters as $param) {
                $requestData[$param] = $this->route($param);
            }
        }

        return $requestData;
    }

    /**
     * @param $user
     *
     * @return  array
     */
    private function hasAnyPermissionAccess($user)
    {
        if (!array_key_exists('permissions', $this->access) || !$this->access['permissions']) {
            return [];
        }

        $permissions = explode('|', $this->access['permissions']);

        $hasAccess = array_map(function ($permission) use ($user) {
            // Note: internal return
            return $user->hasPermissionTo($permission);
        }, $permissions);

        return $hasAccess;
    }

    /**
     * @param $user
     *
     * @return  array
     */
    private function hasAnyRoleAccess($user)
    {
        if (!array_key_exists('roles', $this->access) || !$this->access['roles']) {
            return [];
        }

        $roles = explode('|', $this->access['roles']);

        $hasAccess = array_map(function ($role) use ($user) {
            // Note: internal return
            return $user->hasRole($role);
        }, $roles);

        return $hasAccess;
    }
}
