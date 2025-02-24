<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Actions;

use App\Containers\AppSection\Authentication\Actions\RefreshProxyForWebClientAction;
use App\Containers\AppSection\Authentication\Data\Dto\WebClient\PasswordGrantLoginProxy;
use App\Containers\AppSection\Authentication\Data\Dto\WebClient\RefreshProxy;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\User\Models\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[UsesClass(CallOAuthServerTask::class)]
#[CoversClass(RefreshProxyForWebClientAction::class)]
final class RefreshProxyForWebClientActionTest extends UnitTestCase
{
    public function testCanRefreshToken(): void
    {
        $this->setupPasswordGrantClient();
        $user = User::factory()->createOne(['password' => 'youShallNotPass']);
        $refreshToken = app(CallOAuthServerTask::class)
            ->run(PasswordGrantLoginProxy::create($user->email, 'youShallNotPass'))
            ->refreshToken;
        $action = app(RefreshProxyForWebClientAction::class);

        $response = $action->run(RefreshProxy::create($refreshToken));

        $this->assertSame('refreshToken', $response->refreshTokenCookie->getName());
    }
}
