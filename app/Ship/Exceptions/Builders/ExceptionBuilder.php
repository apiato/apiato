<?php

namespace App\Ship\Exceptions\Builders;

use Exception;
use Illuminate\Http\JsonResponse;

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
    public static function make(Exception $e)
    {
        return new JsonResponse([
            'status' => 'error',
        ]);
    }
}
