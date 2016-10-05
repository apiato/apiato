<?php

namespace App\Containers\Contact\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class ContactUsRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ContactUsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'   => 'email|required',
            'message' => 'min:10|required',
            'name'    => 'min:2',
            'subject' => 'min:2',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
