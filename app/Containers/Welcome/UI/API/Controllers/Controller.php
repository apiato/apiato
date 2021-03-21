<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{

    public function apiRoot(): JsonResponse
    {
        $message = Apiato::call('Welcome@FindMessageForApiRootVisitorAction');
        return response()->json($message);
    }

    public function v1ApiLandingPage(): JsonResponse
    {
        $message = Apiato::call('Welcome@FindMessageForApiV1VisitorAction');
        return response()->json($message);
    }
}
