<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Tests\Unit\UI\API\Requests\EmailVerification;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\EmailVerification\VerifyController;
use App\Containers\AppSection\Authentication\UI\API\Requests\EmailVerification\VerifyRequest;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(VerifyRequest::class)]
final class VerifyRequestTest extends UnitTestCase
{
    private VerifyRequest $request;

    public function testDecode(): void
    {
        self::assertSame([
            'id',
        ], $this->request->getDecode());
    }

    public function testValidationRules(): void
    {
        self::assertSame([], $this->request->rules());
    }

    #[DataProvider('routeHashParamProvider')]
    public function testAuthorization(bool $hashIdEnabled, string $hash, bool $expectation): void
    {
        config(['apiato.hash-id' => $hashIdEnabled]);
        $user = User::factory()->createOne(['email' => 'known@email.test']);
        $this->request->setUserResolver(static fn () => $user);
        $route = Route::getRoutes()->getByAction(VerifyController::class);
        self::assertInstanceOf(\Illuminate\Routing\Route::class, $route);
        $route->bind($this->request);

        $this->request->setRouteResolver(static fn (): \Illuminate\Routing\Route => $route);
        $route->setParameter('id', (string) $user->getHashedKey());
        $route->setParameter('hash', $hash);

        self::assertSame($this->request->authorize(), $expectation);
    }

    public static function routeHashParamProvider(): \Iterator
    {
        yield [true, sha1('known@email.test'), true];
        yield [true, 'known@email.test', false];
        yield [true, sha1('invalid@email.test'), false];
        yield [false, sha1('known@email.test'), true];
        yield [false, 'known@email.test', false];
        yield [false, sha1('invalid@email.test'), false];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new VerifyRequest();
    }
}
