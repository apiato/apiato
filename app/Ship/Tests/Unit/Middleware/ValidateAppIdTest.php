<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Middleware;

use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\API\Controllers\WelcomeController;
use App\Ship\Middleware\ValidateAppId;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ValidateAppId::class)]
final class ValidateAppIdTest extends UnitTestCase
{
    public function testItPassesTheRequestIfIdIsValid(): void
    {
        $request = Request::create(
            action([WelcomeController::class, 'unversioned']),
            server: ['HTTP_App-Identifier' => 'desktop'],
        );
        config([
            'apiato.apps' => [
                'web'     => null,
                'desktop' => null,
                'mobile'  => null,
            ],
        ]);
        $validateAppId = new ValidateAppId();

        $result = $validateAppId->handle($request, static fn (Request $req): Request => $req);

        self::assertSame($request, $result);
    }

    public function testItThrowsIfInvalidAppIdIsProvided(): void
    {
        $this->expectExceptionMessage("App-Identifier header value 'non-existing' is not valid. Allowed values are: web, desktop, mobile");

        $request = Request::create(
            action([WelcomeController::class, 'unversioned']),
            server: ['HTTP_App-Identifier' => 'non-existing'],
        );
        config([
            'apiato.apps' => [
                'web'     => null,
                'desktop' => null,
                'mobile'  => null,
            ],
        ]);
        $validateAppId = new ValidateAppId();

        $validateAppId->handle($request, static fn (Request $req): Request => $req);
    }
}
