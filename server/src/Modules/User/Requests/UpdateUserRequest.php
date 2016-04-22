<?php

namespace Mega\Modules\User\Requests;

use Mega\Services\Core\Request\Abstracts\Request;

/**
 * Class UpdateUserRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
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
            'name' => 'min:2|max:50',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $this->user() is the current logged in user, taken from the request
        // $this->id is the request input user ID (for the user that needs to be updated)
        return policy($this->user())->update($this->user(), $this->id);
    }
}
