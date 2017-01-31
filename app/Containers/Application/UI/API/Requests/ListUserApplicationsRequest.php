<?php

namespace App\Containers\Application\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class ListUserApplicationsRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListUserApplicationsRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {

    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('list-applications');
    }
}
