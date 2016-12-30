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
     * @return  array
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('list-all-users');
    }
}
