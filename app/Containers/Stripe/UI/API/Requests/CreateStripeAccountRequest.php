<?php

namespace App\Containers\Stripe\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class CreateStripeAccountRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [

    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id'       => 'required|min:3',
            'card_id'           => 'required|min:3',
            'card_funding'      => 'sometimes',
            'card_last_digits'  => 'sometimes|integer|min:0|max:9999',
            'card_fingerprint'  => 'sometimes|string',
            'nickname'          => 'required|string|max:190',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
