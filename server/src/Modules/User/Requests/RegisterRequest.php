<?php

namespace Mega\Modules\User\Requests;

use Mega\Services\Core\Request\Abstracts\Request;

/**
 * Class RegisterRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email|max:40',
            'password' => 'required|min:6|max:30',
            'name'     => 'required|min:2|max:50',
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
