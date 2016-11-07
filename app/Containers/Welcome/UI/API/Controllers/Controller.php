<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use App\Port\Controller\Abstracts\PortApiController;
use Illuminate\Support\Facades\Config;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function sayWelcome()
    {
        return response()->json(['Welcome to ' . Config::get('api.name') . '.']);
    }

}
