<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function sayWelcome()
    {
        return response()->json(['Welcome to '.env('API_NAME', 'Please Fill').'.']);
    }
}
