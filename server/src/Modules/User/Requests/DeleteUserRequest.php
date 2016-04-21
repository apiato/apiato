<?php

namespace Mega\Modules\User\Requests;

use Mega\Services\Core\Request\Abstracts\Request;

/**
 * Class DeleteUserRequest.
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
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

        // the request input user ID (for the user that needs to be deleted)
        $inputUserId = $this->id;

        // authorize only if a user is updating it's own record
        return ($currentLoggedInUserId == $inputUserId) ? true : false;
    }
}
