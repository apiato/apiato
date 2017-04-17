<?php

namespace App\Ship\Parents\Actions;

use App\Ship\Engine\Traits\CallableTrait;

/**
 * Class Action.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Action
{

    use CallableTrait;

    /**
     * @var
     */
    protected $ui;

    /**
     * @param $interface
     *
     * @return  $this
     */
    public function setUI($interface)
    {
        $this->ui = $interface;

        return $this;
    }

    /**
     * @return  mixed
     */
    public function getUI()
    {
        return $this->ui;
    }

}
