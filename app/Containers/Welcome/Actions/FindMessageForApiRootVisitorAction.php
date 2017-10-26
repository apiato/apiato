<?php

namespace App\Containers\Welcome\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;

/**
 * Class WelcomeApiRootVisitorAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindMessageForApiRootVisitorAction extends Action
{

    /**
     * @return  array
     */
    public function run()
    {
        return [trans('localization::messages.welcome')];
    }
}
