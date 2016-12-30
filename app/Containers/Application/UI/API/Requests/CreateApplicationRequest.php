<?php

namespace App\Containers\Application\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class CreateApplicationRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateApplicationRequest extends Request
{

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('create-applications');
    }
}
