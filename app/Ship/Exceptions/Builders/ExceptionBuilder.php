<?php

namespace App\Ship\Exceptions\Builders;

use Apiato\Core\Abstracts\Exceptions\Builders\BaseExceptionBuilder;
use Exception;
use Illuminate\Http\JsonResponse;

class ExceptionBuilder extends BaseExceptionBuilder
{
    public static function make(Exception $e)
    {
        return new JsonResponse([
            'status' => 'error',
        ]);
    }
}
