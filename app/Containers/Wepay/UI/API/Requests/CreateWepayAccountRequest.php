<?php

namespace App\Containers\Wepay\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use App\Containers\Wepay\Models\WepayAccount;

/**
 * Class CreateWepayAccountRequest.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class CreateWepayAccountRequest extends Request
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
        $model = new WepayAccount;
        $tableName = $model->getTable();

        return [
            'name'        => 'required|max:40|unique:'.$tableName.',name',
            'description' => 'required|min:4|max:100',
            'type'        => 'required',
            'imageUrl'    => 'required',
            'country'     => 'required',
            'currencies'  => 'required',
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
