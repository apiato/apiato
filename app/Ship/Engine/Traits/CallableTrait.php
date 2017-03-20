<?php

namespace App\Ship\Engine\Traits;

use Illuminate\Support\Facades\App;

/**
 * Class CallableTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait CallableTrait
{

    /**
     * @param       $class
     * @param array $args
     *
     * @return  mixed
     */
    public function call($class, $args = [])
    {
        return App::make($class)->run(...$args);
    }

}
