<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(WebLoginAction::class)]
final class WebLoginActionTest extends UnitTestCase
{
    public static function caseInsensitiveEmailDataProvider(): array
    {
        return [
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gandalf@the.grey',
            ],
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gAndAlf@thE.gReY',
            ],
            [
                'originalCasing' => 'gAndAlf@thE.gReY',
                'loginCasing' => 'gandalf@the.grey',
            ],
        ];
    }

    #[DataProvider('caseInsensitiveEmailDataProvider')]
    public function testCaseInsensitiveLogin(string $originalCasing, string $loginCasing): void
    {
        config()->set('appSection-authentication.login.case_sensitive', false);
        $password = 'youShallNotPass';
        $userDetails = [
            'email' => $originalCasing,
            'password' => $password,
        ];
        $user = UserFactory::new()->createOne($userDetails);
        $credentials = [
            'email' => $loginCasing,
            'password' => $password,
        ];
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        $this->assertTrue($response->isRedirect());
        $this->assertAuthenticatedAs($user, 'web');
    }

    public static function caseSensitiveEmailDataProvider(): array
    {
        return [
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gandalf@the.grey',
                'shouldLogin' => true,
            ],
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gAndAlf@thE.gReY',
                'shouldLogin' => false,
            ],
            [
                'originalCasing' => 'gAndAlf@thE.gReY',
                'loginCasing' => 'gandalf@the.grey',
                'shouldLogin' => false,
            ],
        ];
    }

    #[DataProvider('caseSensitiveEmailDataProvider')]
    public function testCaseSensitiveLogin(string $originalCasing, string $loginCasing, bool $shouldLogin): void
    {
        config()->set('appSection-authentication.login.case_sensitive', true);
        $password = 'youShallNotPass';
        $userDetails = [
            'email' => $originalCasing,
            'password' => $password,
        ];
        $user = UserFactory::new()->createOne($userDetails);
        $credentials = [
            'email' => $loginCasing,
            'password' => $password,
        ];
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        $this->assertTrue($response->isRedirect());
        if ($shouldLogin) {
            $this->assertAuthenticatedAs($user, 'web');
        } else {
            $this->assertGuest('web');
            $this->assertSame('The provided credentials do not match our records.', $response->getSession()->get('errors')->first('email'));
        }
    }

    public function testByDefaultCanAuthenticateUsingEmail(): void
    {
        $credentials = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $user = UserFactory::new()->createOne($credentials);
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $action->run($request);

        $this->assertAuthenticatedAs($user, 'web');
    }
}
