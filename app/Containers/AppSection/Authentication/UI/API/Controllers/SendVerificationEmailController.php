<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\SendVerificationEmailAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class SendVerificationEmailController extends ApiController
{
    /**
     * @param SendVerificationEmailRequest $request
     * @return JsonResponse
     */
    public function sendVerificationEmail(SendVerificationEmailRequest $request): JsonResponse
    {
        app(SendVerificationEmailAction::class)->run($request);

        return $this->accepted();
    }
}
