<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\ForgotPasswordRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ForgotPasswordController extends ApiController
{
    public function __invoke(ForgotPasswordRequest $request, ForgotPasswordAction $action): JsonResponse
    {
        $action->run($request);

        return Response::noContent();
    }
}
