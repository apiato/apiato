<?php

namespace App\Containers\Settings\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class DeleteSettingRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => '',
        'roles' => 'admin',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [
            // put your rules here
            'id' => 'required|exists:settings,id'
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
