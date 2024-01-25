<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Classes;

use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\IncomingLoginField;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LoginFieldProcessor::class)]
final class LoginFieldProcessorTest extends UnitTestCase
{
    public static function loginDataProvider(): array
    {
        $email = 'gandalf@the.grey';
        $name = 'gandalf';
        $extractedEmailField = new IncomingLoginField('email', 'gandalf@the.grey');
        $extractedNameField = new IncomingLoginField('name', 'gandalf');

        return [
            [
                'input' => compact('email'),
                'expected' => [$extractedEmailField],
            ],
            [
                'input' => compact('name'),
                'expected' => [$extractedNameField],
            ],
            [
                'input' => compact('email', 'name'),
                'expected' => [$extractedEmailField, $extractedNameField],
            ],
            [
                'input' => compact('name', 'email'),
                // input order should not matter,
                // results are returned in the order they are defined in the config file.
                'expected' => [$extractedEmailField, $extractedNameField],
            ],
        ];
    }

    #[DataProvider('loginDataProvider')]
    public function testCanExtractUsernames(array $input, array $expected): void
    {
        config()->set('appSection-authentication.login.fields', ['email' => [], 'name' => []]);

        $result = LoginFieldProcessor::extractAll($input);

        $this->assertEquals($result, $expected);
    }

    public function testShouldDiscardUnknownFields(): void
    {
        $credentials = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass, should be discarded',
            'unknown' => 'field, should be discarded',
        ];
        $expected = [new IncomingLoginField('email', 'gandalf@the.grey')];

        $result = LoginFieldProcessor::extractAll($credentials);

        $this->assertEquals($result, $expected);
    }

    public function testUsesEmailFieldAsDefaultFallback(): void
    {
        config()->unset('appSection-authentication.login.fields');
        $credentials = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];
        $expected = [new IncomingLoginField('email', 'gandalf@the.grey')];

        $result = LoginFieldProcessor::extractAll($credentials);

        $this->assertEquals($result, $expected);
    }

    public function testEmptyCredentialsWithException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('No matching login field found');

        LoginFieldProcessor::extractAll([]);
    }

    public static function invalidAllowedLoginFieldsDataProvider(): array
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

    #[DataProvider('invalidAllowedLoginFieldsDataProvider')]
    public function testInvalidAllowedLoginFields(mixed $invalidFields, string $exceptedException, string $exceptedMessage): void
    {
        $this->expectException($exceptedException);
        $this->expectExceptionMessage($exceptedMessage);

        config()->set('appSection-authentication.login.fields', $invalidFields);

        $userDetails = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];

        LoginFieldProcessor::extractAll($userDetails);
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

        config()->set('appSection-authentication.login.fields', 'ThisIsNotArray!');

        $newRules = [
            'password' => 'required',
            'remember' => 'boolean',
        ];

        LoginFieldProcessor::mergeValidationRules($newRules);
    }
}
