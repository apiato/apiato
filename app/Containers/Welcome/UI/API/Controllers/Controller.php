<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use App\Containers\Welcome\Actions\FindMessageForApiRootVisitorAction;
use App\Containers\Welcome\Actions\FindMessageForApiV1VisitorAction;
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
        $message = $this->call(FindMessageForApiRootVisitorAction::class);

        return response()->json($message);
    }

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function v1ApiLandingPage()
    {
        $message = $this->call(FindMessageForApiV1VisitorAction::class);

        return response()->json($message);
    }

}
