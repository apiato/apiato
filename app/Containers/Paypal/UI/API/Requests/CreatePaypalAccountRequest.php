<?php

namespace App\Containers\Paypal\UI\API\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class CreatePaypalAccountRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreatePaypalAccountRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // TODO: To Be Continue...
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
