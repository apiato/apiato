<?php

namespace App\Containers\Authentication\UI\Web\Requests;

use App\Port\Request\Abstracts\Request;

/**
 * Class ViewDashboardRequest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ViewDashboardRequest extends Request
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
        return $this->user()->hasRole('admin');
    }
}
