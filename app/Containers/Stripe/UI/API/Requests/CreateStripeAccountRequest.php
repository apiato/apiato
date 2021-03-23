<?php

namespace App\Containers\Stripe\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class CreateStripeAccountRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'roles' => '',
        'permissions' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [

    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|min:3',
            'card_id' => 'required|min:3',
            'card_funding' => 'sometimes',
            'card_last_digits' => 'sometimes|integer|min:0|max:9999',
            'card_fingerprint' => 'sometimes|string',
            'nickname' => 'required|string|max:190',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
