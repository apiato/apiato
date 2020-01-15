<?php

namespace Apiato\Core\Abstracts\Actions;

use Apiato\Core\Traits\CallableTrait;
use Apiato\Core\Traits\HasRequestCriteriaTrait;

/**
 * Class Action.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Action
{

    use CallableTrait;
    use HasRequestCriteriaTrait;

    /**
     * Set automatically by the controller after calling an Action.
     * Allows the Action to know which UI invoke it, to modify it's behaviour based on it, when needed.
     *
     * @var string
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
