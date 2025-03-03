<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\EmailVerification\SendAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\SendRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class SendController extends ApiController
{
    public function __invoke(SendRequest $request, SendAction $action): JsonResponse
    {
        $action->run($request->user());

        return Response::accepted();
    }
}
