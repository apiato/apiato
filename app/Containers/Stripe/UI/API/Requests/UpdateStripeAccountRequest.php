<?php

namespace App\Containers\Stripe\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class UpdateStripeAccountRequest extends Request
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
        'id',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        'id',
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:stripe_accounts,id',

            'customer_id' => 'sometimes|min:3',
            'card_id' => 'sometimes|min:3',
            'card_funding' => 'sometimes',
            'card_last_digits' => 'sometimes|integer|min:0|max:9999',
            'card_fingerprint' => 'sometimes|string',
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
