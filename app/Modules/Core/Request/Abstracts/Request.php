<?php

namespace App\Modules\Core\Request\Abstracts;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as LaravelFrameworkRequest;
use App\Modules\Core\Exception\Exceptions\ValidationFailedException;

/**
 * Class Request
 *
 * A.K.A (app/Http/Requests/Request.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Request extends LaravelFrameworkRequest
{

    /**
     * overriding the failedValidation function to throw my custom
     * exception instead of the default Laravel exception.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return mixed|void
     */
    public function failedValidation(Validator $validator)
    {
        throw new ValidationFailedException($validator->getMessageBag());
    }
}
