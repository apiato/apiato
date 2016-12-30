<?php

namespace App\Containers\User\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class RegisterVisitorRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterVisitorRequest extends Request
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
        return true;
    }
}
