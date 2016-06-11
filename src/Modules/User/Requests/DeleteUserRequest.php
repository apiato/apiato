<?php

namespace Hello\Modules\User\Requests;

use Illuminate\Contracts\Auth\Access\Gate;
use Hello\Modules\User\Models\User;
use Hello\Modules\Core\Request\Abstracts\Request;

/**
 * Class DeleteUserRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
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
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return bool
     */
    public function authorize(Gate $gate)
    {
        // $this->user(): is the current logged in user, taken from the request
        // $this->id: is the request input user ID (for the user that needs to be updated)
        return $gate->getPolicyFor(User::class)->update($this->user(), $this->id);
    }
}
