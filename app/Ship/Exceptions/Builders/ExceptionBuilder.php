<?php

namespace App\Ship\Exceptions\Builders;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * Class ExceptionBuilder
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ExceptionBuilder
{

    /**
     * @param Exception $e
     *
     * @return  JsonResponse
     */
    public static function make(Throwable $e)
    {
        return new JsonResponse([
            'status' => 'error',
        ]);
    }
}
