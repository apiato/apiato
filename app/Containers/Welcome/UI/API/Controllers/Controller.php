<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Support\Facades\Config;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function sayWelcome()
    {
        return response()->json(['Welcome to ' . Config::get('apiato.app_name') . '.']);
    }

}
