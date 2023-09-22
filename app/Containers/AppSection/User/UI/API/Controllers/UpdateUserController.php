<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\UI\API\Documentation\Parameters\UpdateUser;
use App\Containers\AppSection\User\UI\API\Documentation\Responses\UserTransformerResponse;
use App\Containers\AppSection\User\UI\API\Documentation\SecuritySchemes\BearerTokenSecurityScheme;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Vyuldashev\LaravelOpenApi\Attributes\Collection;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\Parameters;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\Response as ResponseAttr;
use Illuminate\Http\JsonResponse;

#[PathItem]
final class UpdateUserController extends ApiController

{
    /**
     * Update users
     *
     * Description for body
     */
    #[Operation(security: BearerTokenSecurityScheme::class)]
    #[Parameters(factory: UpdateUser::class)]
    #[ResponseAtt(factory: UserTransformerResponse::class)]
    #[Collection(['private'])]
    public function __invoke(UpdateUserRequest $request, UpdateUserAction $action): JsonResponse
    {
        $user = $action->run(
            $request->user_id,
            $request->sanitize([
                'name',
                'gender',
                'birth',
                'password' => $request->new_password,
            ]),
        );

        return Response::create($user, UserTransformer::class)->ok();
    }
}
