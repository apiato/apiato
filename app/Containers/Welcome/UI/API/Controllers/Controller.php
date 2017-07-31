<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use App\Containers\Welcome\Actions\GetMessageForApiRootVisitorAction;
use App\Containers\Welcome\Actions\GetMessageForApiV1VisitorAction;
use App\Ship\Parents\Controllers\ApiController;

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
        $message = $this->call(GetMessageForApiRootVisitorAction::class);

        return response()->json($message);
    }

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function v1ApiLandingPage()
    {
        $message = $this->call(GetMessageForApiV1VisitorAction::class);

        return response()->json($message);
    }

}
