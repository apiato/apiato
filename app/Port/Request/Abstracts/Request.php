<?php

namespace App\Port\Request\Abstracts;

use App\Containers\User\Models\User;
use App\Port\Exception\Exceptions\IncorrectIdException;
use App\Port\Exception\Exceptions\ValidationFailedException;
use App\Port\HashId\Traits\HashIdTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as LaravelFrameworkRequest;
use Illuminate\Support\Facades\Config;

/**
 * Class Request
 *
 * A.K.A (app/Http/Requests/Request.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Request extends LaravelFrameworkRequest
{

    use HashIdTrait;

    /**
     * This function will be called from the Requests (authorize) to check if a user
     * has permission to perform an action.
     * User can set multiple permissions (separated with "|") and if the user has
     * any of the permissions, he will be authorize to proceed with this action.
     *
     * @return  bool
     */
    public function hasAccess(User $user = null)
    {
        if(!$user){
            $user = $this->user();
        }

        // $this->access is optionally set on the Request

        // allow access when the access is not defined
        // allow access when nothing no roles or permissions are declared
        if (!isset($this->access) || !isset($this->access['permission'])) {
            return true;
        }

        // allow access if has permission set but is empty or null
        if (!$this->access['permission']) {
            return true;
        }

        $permissions = explode('|', $this->access['permission']);

        $hasAccess = array_map(function ($permission) use ($user){
            return $user->hasPermissionTo($permission);
        }, $permissions);

        // allow access if user has access to any of the defined permissions.
        return in_array(true, $hasAccess);
    }

    /**
     * Overriding this function to modify the any user input before
     * applying the validation rules.
     *
     * @return  array
     */
    public function all()
    {
        $requestData = parent::all();

        // the hash ID feature must be enabled to use this decoder feature.
        if (Config::get('hello.hash-id') && isset($this->decode) && !empty($this->decode)) {
            $requestData = $this->decodeHashedIdsBeforeValidatingThem($requestData);
        }

        if (isset($this->urlParameters) && !empty($this->urlParameters)) {
            $requestData = $this->applyValidationRulesToUrlParams($requestData);
        }

        return $requestData;
    }

    /**
     * without decoding the encoded ID's you won't be able to use
     * validation features like `exists:table,id`
     *
     * @param array $requestData
     *
     * @return  array
     */
    private function decodeHashedIdsBeforeValidatingThem(Array $requestData)
    {
        foreach ($this->decode as $id) {

            if (isset($requestData[$id])) {
                // validate the user is not trying to pass real ID
                if (is_numeric($requestData[$id])) {
                    throw new IncorrectIdException('Only Hashed ID\'s allowed to be passed.');
                }

                // perform the decoding
                $requestData[$id] = $this->decodeThisId($requestData[$id]);
            } // do nothing if the input is incorrect, because what if it's not required!
        }

        return $requestData;
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
    private function applyValidationRulesToUrlParams(Array $requestData)
    {
        foreach ($this->urlParameters as $param) {
            $requestData[$param] = $this->route($param);
        }

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
        throw new ValidationFailedException($validator->getMessageBag());
    }
}
