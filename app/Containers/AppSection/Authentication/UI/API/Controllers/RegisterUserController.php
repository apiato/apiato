<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\UI\API\Documentation\Parameters\RegisterUserParams;
use App\Containers\AppSection\Authentication\UI\API\Documentation\Responses\RegisterUserResponse;
use App\Containers\AppSection\Authentication\UI\API\Documentation\SecuritySchemes\BearerTokenSecurityScheme;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Documentation\Collections\PrivateCollection;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\LaravelOpenApi\Attributes\Operation;
use MohammadAlavi\LaravelOpenApi\Attributes\PathItem;

#[PathItem]
#[Collection(PrivateCollection::class)]
final class RegisterUserController extends ApiController
{
    #[Operation(
        parameters: RegisterUserParams::class,
        responses: RegisterUserResponse::class,
        //        security: BearerTokenSecurityScheme::class,
    )]
    public function __invoke(RegisterUserRequest $request, RegisterUserAction $action): JsonResponse
    {
        $user = $action->transactionalRun($request->sanitize([
            'email',
            'password',
            'name',
            'gender',
            'birth',
        ]));

        return Response::create($user, UserTransformer::class)->ok();
    }
}
