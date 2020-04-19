<?php

namespace App\Ship\Exceptions\Builders;

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
     * @param \Exception $e
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public static function make(Throwable $e)
    {
        return new JsonResponse([
            'status' => 'error',
        ]);
    }
}
