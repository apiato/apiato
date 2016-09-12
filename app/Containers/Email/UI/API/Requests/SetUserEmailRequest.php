<?php

namespace App\Containers\Email\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class SetUserEmailRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetUserEmailRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:40',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: add policy checking if the user is authorized to set his own Email

        return true;
    }
}
