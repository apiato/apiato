<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use Illuminate\Support\Facades\Config;

/**
 * @group authentication
 * @group unit
 */
class LoginCustomAttributeTest extends UnitTestCase
{
    public function testGivenValidLoginAttributeThenExtractUsername(): void
    {
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = LoginCustomAttribute::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    private function assertAttributeIsExtracted(array $result, array $userDetails): void
    {
        [$loginFieldValue, $loginFieldName] = $result;
        $this->assertSame($loginFieldValue, strtolower($userDetails['email']));
        $this->assertSame($loginFieldName, 'email');
    }

    public function testWhenNoLoginAttributeIsProvidedShouldUseEmailFieldAsDefaultFallback(): void
    {
        Config::offsetUnset('appSection-authentication.login.attributes');
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = LoginCustomAttribute::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }
}
