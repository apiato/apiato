<?php

namespace Mega\Modules\User\Requests;

use Mega\Services\Core\Request\Abstracts\Request;

/**
 * Class UpdateUserRequest
 *
 * @type     Request
 * @package  Mega\Interfaces\Api\Requests
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateUserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'min:6|max:30',
            'name'     => 'min:2|max:50',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // current logged in user ID
        $currentLoggedInUserId = $this->user()->id;

        // the request input user ID (for the user that needs to be updated)
        $inputUserId = $this->id;

        // authorize only if a user is updating it's own record
        return ($currentLoggedInUserId == $inputUserId) ? true : false;
    }


}
