<?php

namespace App\Port\Request\Manager;

use App\Port\Request\Abstracts\Request;

/**
 * Class HttpRequest.
 *
 * General request to be used in the Controllers of the GET endpoints,
 * to collect some data from the request like Headers or the Auth User,..
 * (without the need of creating an empty request just for that).
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class HttpRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
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
