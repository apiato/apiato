<?php

namespace App\Containers\User\UI\API\Requests;

use App\Containers\User\Models\User;
use App\Port\Request\Abstracts\Request;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Class ListAllUsersRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllUsersRequest extends Request
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
     */
    public function authorize(Gate $gate)
    {
        return $gate->getPolicyFor(User::class)->list($this->user());
    }
}
