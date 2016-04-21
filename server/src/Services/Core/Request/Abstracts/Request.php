<?php

namespace Mega\Services\Core\Request\Abstracts;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as LaravelFrameworkRequest;
use Mega\Services\Core\Exception\Exceptions\ValidationFailedException;

/**
 * Class Request.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
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
