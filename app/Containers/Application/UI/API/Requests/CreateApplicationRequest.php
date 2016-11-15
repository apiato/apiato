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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
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
