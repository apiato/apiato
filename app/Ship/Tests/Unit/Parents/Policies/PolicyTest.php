<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Parents\Policies;

use App\Ship\Parents\Models\UserModel;
use App\Ship\Parents\Policies\Policy;
use App\Ship\Parents\Requests\Request as ParentRequest;
use App\Ship\Tests\Fakes\Policies\FakeCreatePoliciesRequest;
use App\Ship\Tests\Fakes\Policies\FakeDeletePoliciesRequest;
use App\Ship\Tests\Fakes\Policies\FakeUpdatePoliciesRequest;
use App\Ship\Tests\Fakes\Policies\FakeViewPoliciesRequest;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Auth\Access\Gate;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

#[CoversClass(Policy::class)]
final class PolicyTest extends ShipTestCase
{
    #[DataProvider('getTestingUserDataProvider')]
    public function testUserCanCreatePolicy(ParentRequest $fakeRequest, Response $expectedResponse): void
    {
        $user = TestUserFactory::new()->createOne();
        $this->actingAs($user, 'api');

        $fakeRequest->setUserResolver(static fn (): ?UserModel => $user);

        self::assertEquals(
            $expectedResponse,
            $fakeRequest->authorize(app(Gate::class)),
        );
    }

    public static function getTestingUserDataProvider(): \Iterator
    {
        yield 'create' => [
            FakeCreatePoliciesRequest::create('/', Request::METHOD_POST),
            Response::allow('create', SymfonyResponse::HTTP_CREATED),
        ];
        yield 'view' => [
            FakeViewPoliciesRequest::create('/', Request::METHOD_GET),
            Response::allow(null, null),
        ];
        yield 'update' => [
            FakeUpdatePoliciesRequest::create('/', Request::METHOD_PUT),
            Response::deny(null, null),
        ];
        yield 'delete' => [
            FakeDeletePoliciesRequest::create('/', Request::METHOD_DELETE),
            Response::deny('delete', SymfonyResponse::HTTP_FORBIDDEN),
        ];
    }
}
