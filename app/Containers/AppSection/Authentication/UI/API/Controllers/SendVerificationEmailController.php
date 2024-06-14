<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class SendVerificationEmailController extends ApiController
{
    public function __invoke(SendVerificationEmailRequest $request, SendVerificationEmailAction $action): JsonResponse
    {
        $action->run($request);

        return Response::accepted();
    }
}
