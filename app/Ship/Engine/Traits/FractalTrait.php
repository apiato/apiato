<?php

namespace App\Ship\Engine\Traits;


use Fractal;

/**
 * Class ResponseTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait FractalTrait
{

    /**
     * @param $data
     * @param $transformerName
     *
     * @return  mixed
     */
    public function respond($data, $transformerName = null)
    {
        return Fractal::create($data, new $transformerName)->toJson();
    }

}
