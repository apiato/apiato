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
    public function apiRoot()
    {
        return response()->json(['Welcome to ' . Config::get('app.name') . '.']);
    }

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function v1ApiLandingPage()
    {
        return response()->json(['Welcome to ' . Config::get('app.name') . ' (API V1).']);
    }

}
