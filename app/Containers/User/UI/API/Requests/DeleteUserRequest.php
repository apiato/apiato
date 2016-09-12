<?php

namespace App\Containers\User\UI\API\Requests;

use Illuminate\Contracts\Auth\Access\Gate;
use App\Containers\User\Models\User;
use App\Port\Request\Abstracts\Request;

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
        return [

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return bool
     */
    public function authorize(Gate $gate, GetAuthenticatedUserTask $getAuthenticatedUserTask)
    {
        return $gate->getPolicyFor(User::class)->update($this->user(), $getAuthenticatedUserTask->run()->id);
    }
}
