<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\EmailVerification\VerifyAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\VerifyRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class VerifyController extends ApiController
{
    public function __invoke(VerifyRequest $request, VerifyAction $action): JsonResponse
    {
        $action->run($request->user());

        return Response::ok();
    }
}
