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

    private function assertAttributeIsExtracted(array $result, array $userDetails): void
    {
        list($username, $loginAttribute) = $result;
        $this->assertSame($username, $userDetails['email']);
        $this->assertSame($loginAttribute, 'email');
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
