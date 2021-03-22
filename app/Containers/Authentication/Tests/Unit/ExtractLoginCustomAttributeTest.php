<?php

namespace App\Containers\Authentication\Tests\Unit;

use App\Containers\Authentication\Data\Transporters\LoginTransporter;
use App\Containers\Authentication\Tasks\ExtractLoginCustomAttributeTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class ExtractLoginCustomAttributeTest.
 *
 * @group authentication
 * @group unit
 *
 */
class ExtractLoginCustomAttributeTest extends TestCase
{
    public function testGivenValidLoginAttributeThenExtractUsername(): void
    {
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $task = App::make(ExtractLoginCustomAttributeTask::class);

        $result = $task->run($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    private function assertAttributeIsExtracted($result, $userDetails): void
    {
        self::assertIsArray($result);
        self::assertArrayHasKey('username', $result);
        self::assertArrayHasKey('loginAttribute', $result);
        self::assertSame($result['username'], $userDetails['email']);
    }

    public function testWhenNoLoginAttributeIsProvidedShouldUseEmailFieldAsDefaultFallback(): void
    {
        Config::offsetUnset('authentication-container.login.attributes');

        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];
        $task = App::make(ExtractLoginCustomAttributeTask::class);

        $result = $task->run($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }
}
