<?php

namespace App\Containers\Email\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class ConfirmUserEmailRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ConfirmUserEmailRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'   => 'required|integer', // url parameter
            'code' => 'required|min:35|max:45', // url parameter
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
        $data['code'] = $this->route('code');

        return $data;
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
