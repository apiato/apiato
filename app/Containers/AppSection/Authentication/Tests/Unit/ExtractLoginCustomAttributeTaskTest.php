<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use Illuminate\Support\Facades\Config;

/**
 * Class ExtractLoginCustomAttributeTaskTest.
 *
 * @group authentication
 * @group unit
 *
 */
class ExtractLoginCustomAttributeTaskTest extends TestCase
{
    public function testGivenValidLoginAttributeThenExtractUsername(): void
    {
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = app(ExtractLoginCustomAttributeTask::class)->run($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    private function assertAttributeIsExtracted($result, $userDetails): void
    {
        $this->assertIsArray($result);
        $this->assertArrayHasKey('username', $result);
        $this->assertArrayHasKey('loginAttribute', $result);
        $this->assertSame($result['username'], $userDetails['email']);
    }

    public function testWhenNoLoginAttributeIsProvidedShouldUseEmailFieldAsDefaultFallback(): void
    {
        Config::offsetUnset('appSection-authentication.login.attributes');
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = app(ExtractLoginCustomAttributeTask::class)->run($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }
}
