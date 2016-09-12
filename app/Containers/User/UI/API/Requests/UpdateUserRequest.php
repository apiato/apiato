<?php

namespace App\Containers\User\UI\API\Requests;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Models\User;
use App\Port\Request\Abstracts\Request;
use Illuminate\Contracts\Auth\Access\Gate;

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
            'name'     => 'min:2|max:50',
            'email'    => 'email',
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
