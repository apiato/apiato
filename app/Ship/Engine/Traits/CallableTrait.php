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
        $action = App::make($class);

        if(method_exists($action, 'setUI')){
            // $this->ui is coming, should be attached on the parent controller, from where the actions was called.
            // It can be WebController and ApiController. Each of them has ui, to inform the action
            // if it needs to handle the request differently.
            $action->setUI($this->ui);
        }

        return $action->run(...$args);
    }

}
