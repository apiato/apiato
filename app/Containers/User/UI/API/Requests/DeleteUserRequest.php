<?php

namespace App\Containers\User\UI\API\Requests;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
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
     * @param \Illuminate\Contracts\Auth\Access\Gate                        $gate
     * @param \App\Containers\Authentication\Tasks\GetAuthenticatedUserTask $getAuthenticatedUserTask
     *
     * @return  mixed
     */
    public function authorize(Gate $gate, GetAuthenticatedUserTask $getAuthenticatedUserTask)
    {
        // NOTE: the comment below is just a reference for how to use the policies, since now
        //       a user is authorized to delete himself.
        //$gate->getPolicyFor(User::class)->update($this->user(), $getAuthenticatedUserTask->run()->id);

        return true;
    }
}
