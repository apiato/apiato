<?php

namespace App\Ship\Features\Generator\Interfaces;

use Closure;

/**
 * Class ComponentsGenerator
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
interface ComponentsGenerator
{

    /**
     * @param \Closure $initialize
     * @param \Closure $terminate
     *
     * @return  mixed
     */
    public function fireMe(Closure $initialize, Closure $terminate);

}
