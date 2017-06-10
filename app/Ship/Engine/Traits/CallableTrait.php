<?php

namespace App\Ship\Engine\Traits;

use Illuminate\Support\Facades\App;
use function is_array;
use function key;

/**
 * Class CallableTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait CallableTrait
{

    /**
     * @param       $class
     * @param array $runArguments
     * @param array $methods
     *
     * @return  mixed
     */
    public function call($class, $runArguments = [], $methods = [])
    {
        $action = App::make($class);

        // $this->ui is coming, should be attached on the parent controller, from where the actions was called.
        // It can be WebController and ApiController. Each of them has ui, to inform the action
        // if it needs to handle the request differently.
        if (method_exists($action, 'setUI')) {
            $action->setUI($this->ui);
        }

        // allows calling other methods in the class before calling the main `run` function.
        foreach ($methods as $methodInfo) {
            // if is array means it has arguments
            if (is_array($methodInfo)) {
                $method = key($methodInfo);
                $arguments = $methodInfo[$method];
                if (method_exists($action, $method)) {
                    $action->$method(...$arguments);
                }
            } else {
                // if is string means it's just the function name
                if (method_exists($action, $methodInfo)) {
                    $action->$methodInfo();
                }
            }
        }

        return $action->run(...$runArguments);
    }

}
