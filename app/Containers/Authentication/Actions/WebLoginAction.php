<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Http\Request;
/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        return $this->call(WebLoginTask::class, [$request]);;
    }
}
