<?php

namespace App\Containers\Authentication\UI\API\Requests;

use App\Containers\Authentication\Data\Transporters\ProxyRefreshTransporter;
use App\Ship\Parents\Requests\Request;

/**
 * Class ProxyRefreshRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ProxyRefreshRequest extends Request
{
    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = ProxyRefreshTransporter::class;

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
        return [

        ];
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
