<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class SendVerificationEmailController extends ApiController
{
    public function __invoke(SendVerificationEmailRequest $request, SendVerificationEmailAction $action): JsonResponse
    {
        $action->run($request);

        return $this->accepted();
    }
}
