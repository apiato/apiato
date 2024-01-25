<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Classes;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LoginFieldProcessor::class)]
final class LoginFieldProcessorTest extends UnitTestCase
{
    public function testGivenValidLoginAttributeThenExtractUsername(): void
    {
        $userDetails = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];

        $result = LoginFieldProcessor::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    private function assertAttributeIsExtracted(array $result, array $userDetails): void
    {
        [$loginFieldValue, $loginFieldName] = $result;
        $this->assertSame($loginFieldValue, strtolower($userDetails['email']));
        $this->assertSame($loginFieldName, 'email');
    }

    public function testGivenInvalidLoginAttributeThenExtractUsername(): void
    {
        $this->expectException(NotFoundException::class);

        $userDetails = [
            'email' => (int) 'ThisIsNotString!',
        ];

        LoginFieldProcessor::extract($userDetails);
    }

    public function testWhenNoLoginAttributeIsProvidedShouldUseEmailFieldAsDefaultFallback(): void
    {
        Config::offsetUnset('appSection-authentication.login.fields');
        $userDetails = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];

        $result = LoginFieldProcessor::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    public function testCanLoginWithUppercaseEmail(): void
    {
        Config::set('appSection-authentication.login.case_sensitive', false);
        $userDetails = [
            'email' => 'gAndAlf@tHe.grEy',
            'password' => 'youShallNotPass',
            'name' => 'Mahmoud',
        ];
        $this->testingUser = UserFactory::new()->createOne($userDetails);
        $request = LoginRequest::injectData($userDetails);
        //        $request = LoginRequest::injectData([
        //            'email' => 'gandalf@the.grey',
        //            'password' => 'youShallNotPass',
        //        ]);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        $this->assertTrue($response->isRedirect());
        $this->assertAuthenticatedAs($this->testingUser, 'web');
    }

    public static function caseInvalidAllowedLoginFieldsDataProvider(): array
    {
        return [
            [
                'ThisIsNotArray!',
                \InvalidArgumentException::class,
                'Login {fields} property must be an array, string given',
            ],
            [
                [(int) 'ThisIsNotString!'],
                \InvalidArgumentException::class,
                'Login fields keys must be a string, integer given',
            ],
        ];
    }

    #[DataProvider('caseInvalidAllowedLoginFieldsDataProvider')]
    public function testInvalidAllowedLoginFields(mixed $invalidFields, string $exceptedException, string $exceptedMessage): void
    {
        $this->expectException($exceptedException);
        $this->expectExceptionMessage($exceptedMessage);

        Config::set('appSection-authentication.login.fields', $invalidFields);

        $userDetails = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];

        LoginFieldProcessor::extract($userDetails);
    }

    public function testMergeValidValidationRulesWithOneAllowedLoginField(): void
    {
        $newRules = [
            'password' => 'required',
            'remember' => 'boolean',
        ];

        Config::set('appSection-authentication.login.fields', ['email' => ['email']]);

        $result = LoginFieldProcessor::mergeValidationRules($newRules);

        $this->assertArrayHasKey('email', $result);
        $this->assertSame($result['email'], 'required:email|email');
        $this->assertValidValidationRulesIsMerged($result, $newRules);
    }

    public function testMergeValidValidationRulesWithManyAllowedLoginFields(): void
    {
        $newRules = [
            'password' => 'required',
            'remember' => 'boolean',
        ];

        Config::set('appSection-authentication.login.fields', [
            'email' => ['email'],
            'login' => ['string', 'required'],
        ]);

        $result = LoginFieldProcessor::mergeValidationRules($newRules);

        $this->assertArrayHasKey('email', $result);
        $this->assertSame($result['email'], 'required_without_all:login|email');
        $this->assertArrayHasKey('login', $result);
        $this->assertSame($result['login'], 'required_without_all:email|string|required');
        $this->assertValidValidationRulesIsMerged($result, $newRules);
    }

    private function assertValidValidationRulesIsMerged(array $result, array $newRules): void
    {
        foreach ($newRules as $ruleName => $ruleValue) {
            $this->assertArrayHasKey($ruleName, $result);
            $this->assertSame($result[$ruleName], $ruleValue);
        }
    }

    public function testMergeValidationRulesWithException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The login fields must be an array');

        Config::set('appSection-authentication.login.fields', 'ThisIsNotArray!');

        $newRules = [
            'password' => 'required',
            'remember' => 'boolean',
        ];

        LoginFieldProcessor::mergeValidationRules($newRules);
    }
}
