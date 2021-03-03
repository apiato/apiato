<?php

namespace App\Containers\Authentication\UI\API\Requests;

use App\Containers\Authentication\Data\Transporters\ProxyLoginPasswordGrantTransporter;
use App\Ship\Parents\Requests\Request;

/**
 * Class ProxyLoginPasswordGrantRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ProxyLoginPasswordGrantRequest extends Request
{
    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = ProxyLoginPasswordGrantTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => null,
        'roles' => null,
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
    public function rules(): array
    {
        $rules = [
            'password' => 'required|min:3|max:30',
        ];

        $rules = loginAttributeValidationRulesMerger($rules);

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
