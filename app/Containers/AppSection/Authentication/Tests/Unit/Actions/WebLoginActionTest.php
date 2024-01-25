<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(WebLoginAction::class)]
final class WebLoginActionTest extends UnitTestCase
{
    public static function caseInsensitiveDataProvider(): array
    {
        $emailField = 'email';
        $nameField = 'name';

        return [
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gandalf@the.grey',
                'field' => $emailField,
            ],
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gAndAlf@thE.gReY',
                'field' => $emailField,
            ],
            [
                'originalCasing' => 'gAndAlf@thE.gReY',
                'loginCasing' => 'gandalf@the.grey',
                'field' => $emailField,
            ],
            [
                'originalCasing' => 'gandalf',
                'loginCasing' => 'gandalf',
                'field' => $nameField,
            ],
            [
                'originalCasing' => 'gandalf',
                'loginCasing' => 'gAndAlf',
                'field' => $nameField,
            ],
            [
                'originalCasing' => 'gAndAlf',
                'loginCasing' => 'gandalf',
                'field' => $nameField,
            ],
        ];
    }

    public static function caseSensitiveEmailDataProvider(): array
    {
        $emailField = 'email';
        $nameField = 'name';

        return [
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gandalf@the.grey',
                'shouldLogin' => true,
                'field' => $emailField,
            ],
            [
                'originalCasing' => 'gandalf@the.grey',
                'loginCasing' => 'gAndAlf@thE.gReY',
                'shouldLogin' => false,
                'field' => $emailField,
            ],
            [
                'originalCasing' => 'gAndAlf@thE.gReY',
                'loginCasing' => 'gandalf@the.grey',
                'shouldLogin' => false,
                'field' => $emailField,
            ],
            [
                'originalCasing' => 'gandalf',
                'loginCasing' => 'gandalf',
                'shouldLogin' => true,
                'field' => $nameField,
            ],
            [
                'originalCasing' => 'gandalf',
                'loginCasing' => 'gAndAlf',
                'shouldLogin' => false,
                'field' => $nameField,
            ],
            [
                'originalCasing' => 'gAndAlf',
                'loginCasing' => 'gandalf',
                'shouldLogin' => false,
                'field' => $nameField,
            ],
        ];
    }

    public static function allowedLoginDataProvider(): array
    {
        return [
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'email',
                ],
            ],
            // Should fail because name is not allowed
            // [
            //     'loginFields' => [
            //         'name' => 'gandalf',
            //     ],
            //     'allowedFields' => [
            //         'email',
            //     ],
            // ],
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'email',
                ],
            ],
            [
                'loginFields' => [
                    'name' => 'gandalf',
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'email',
                ],
            ],
            // Should fail because email is not allowed
            // [
            //     'loginFields' => [
            //         'email' => 'gandalf@the.grey',
            //     ],
            //     'allowedFields' => [
            //         'name',
            //     ],
            // ],
            [
                'loginFields' => [
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'name',
                ],
            ],
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'name',
                ],
            ],
            [
                'loginFields' => [
                    'name' => 'gandalf',
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'name',
                ],
            ],
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'email',
                    'name',
                ],
            ],
            [
                'loginFields' => [
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'email',
                    'name',
                ],
            ],
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'email',
                    'name',
                ],
            ],
            [
                'loginFields' => [
                    'name' => 'gandalf',
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'email',
                    'name',
                ],
            ],
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'name',
                    'email',
                ],
            ],
            [
                'loginFields' => [
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'name',
                    'email',
                ],
            ],
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'name',
                    'email',
                ],
            ],
            [
                'loginFields' => [
                    'name' => 'gandalf',
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'name',
                    'email',
                ],
            ],
        ];
    }

    public static function unallowedLoginDataProvider(): array
    {
        return [
            [
                'loginFields' => [
                    'name' => 'gandalf',
                ],
                'allowedFields' => [
                    'email',
                ],
            ],
            [
                'loginFields' => [
                    'email' => 'gandalf@the.grey',
                ],
                'allowedFields' => [
                    'name',
                ],
            ],
        ];
    }

    #[DataProvider('caseInsensitiveDataProvider')]
    public function testCaseInsensitiveLogin(string $originalCasing, string $loginCasing, string $field): void
    {
        config()->set('appSection-authentication.login.case_sensitive', false);
        config()->set('appSection-authentication.login.fields', [$field => []]);
        $password = 'youShallNotPass';
        $userDetails = [
            $field => $originalCasing,
            'password' => $password,
        ];
        $user = UserFactory::new()->createOne($userDetails);
        $credentials = [
            $field => $loginCasing,
            'password' => $password,
        ];
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        $this->assertTrue($response->isRedirect());
        $this->assertAuthenticatedAs($user, 'web');
    }

    #[DataProvider('caseSensitiveEmailDataProvider')]
    public function testCaseSensitiveLogin(string $originalCasing, string $loginCasing, bool $shouldLogin, string $field): void
    {
        config()->set('appSection-authentication.login.case_sensitive', true);
        config()->set('appSection-authentication.login.fields', [$field => []]);
        $password = 'youShallNotPass';
        $userDetails = [
            $field => $originalCasing,
            'password' => $password,
        ];
        $user = UserFactory::new()->createOne($userDetails);
        $credentials = [
            $field => $loginCasing,
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
            $this->assertSame(__('auth.failed'), $response->getSession()->get('errors')->first($field));
        }
    }

    public function testUsesEmailFieldAsDefaultLoginFieldFallback(): void
    {
        config()->unset('appSection-authentication.login.fields');
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

    #[DataProvider('allowedLoginDataProvider')]
    public function testCanAuthenticateUsingAllowedLoginFields(array $loginFields, array $allowedFields): void
    {
        config()->set('appSection-authentication.login.fields', $this->prepareForConfig($allowedFields));
        $credentials = [
            ...$loginFields,
            'password' => 'youShallNotPass',
        ];
        $user = UserFactory::new()->createOne($credentials);
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $action->run($request);

        $this->assertAuthenticatedAs($user, 'web');
    }

    private function prepareForConfig(array $allowedFields): array
    {
        $config = [];
        foreach ($allowedFields as $key => $field) {
            $config[$field] = [];
        }

        return $config;
    }

    #[DataProvider('unallowedLoginDataProvider')]
    public function testCanAuthenticateUsingOnlyAllowedLoginFields(array $loginFields, array $allowedFields): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('No matching login field found');

        config()->set('appSection-authentication.login.fields', $this->prepareForConfig($allowedFields));
        $credentials = [
            ...$loginFields,
            'password' => 'youShallNotPass',
        ];
        UserFactory::new()->createOne($credentials);
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $action->run($request);
    }

    public function testCanReturnMultipleErrors(): void
    {
        config()->set('appSection-authentication.login.fields', ['email' => [], 'name' => []]);
        $credentials = [
            'email' => 'gandalf@the.grey',
            'name' => 'gandalf',
            'password' => 'youShallNotPass',
        ];
        UserFactory::new()->createOne($credentials);
        $authSpy = Auth::spy();
        $authSpy->allows()->guard('web')->andReturnSelf();
        $authSpy->allows()->attempt($credentials)->andReturn(false);
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        /** @var MessageBag $errors */
        $errors = $response->getSession()->get('errors');
        foreach (['email', 'name'] as $field) {
            $this->assertTrue($errors->has($field));
            $this->assertCount(1, $errors->get($field));
            $this->assertSame(__('auth.failed'), $errors->get($field)[0]);
        }
        $this->assertTrue($response->isRedirect());
    }

    public function testCanLoginWithMultipleLoginFieldsEvenIfOneFieldIsCorrect(): void
    {
        config()->set('appSection-authentication.login.fields', ['email' => [], 'name' => []]);
        $userDetails = [
            'email' => 'ganldalf@the.grey',
            'name' => 'gandalf',
            'password' => 'youShallNotPass',
        ];
        $user = UserFactory::new()->createOne($userDetails);
        $credentials = [
            'email' => 'ganldalf@the.white', // wrong email
            'name' => 'gandalf', // correct name
            'password' => 'youShallNotPass',
        ];
        $request = LoginRequest::injectData($credentials);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        $this->assertTrue($response->isRedirect());
        $this->assertAuthenticatedAs($user, 'web');
    }
}
