<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use App\Ship\Controller\Abstracts\ShipApiController;
use Illuminate\Support\Facades\Config;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ShipApiController
{

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function sayWelcome()
    {
        return response()->json(['Welcome to ' . Config::get('api.name') . '.']);
    }

}
