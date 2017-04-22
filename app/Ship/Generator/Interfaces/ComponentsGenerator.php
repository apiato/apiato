<?php

namespace App\Ship\Generator\Interfaces;

use Closure;

/**
 * Class ComponentsGenerator
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
interface ComponentsGenerator
{

    /**
     * @return  mixed
     */
    public function getUserInputs();

}
