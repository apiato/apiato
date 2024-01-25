<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Classes;

use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\Values\IncomingLoginField;
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
}
