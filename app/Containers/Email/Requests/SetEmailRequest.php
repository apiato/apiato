<?php

namespace App\Containers\Email\Requests;

use App\Kernel\Request\Abstracts\Request;

/**
 * Class SetEmailRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class SetEmailRequest extends Request
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
            'id'    => 'required|integer', // url parameter
        ];
    }

    /**
     * Override the all() to automatically apply validation rules to the URL parameters
     *
     * @return  array
     */
    public function all()
    {
        $data = parent::all();
        $data['id'] = $this->route('id');

        return $data;
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
