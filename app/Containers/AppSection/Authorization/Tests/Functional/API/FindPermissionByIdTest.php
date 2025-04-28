<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory;
use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class FindPermissionByIdTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/permissions/{permission_id}';

    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles'       => null,
    ];

    public function testFindPermissionById(): void
    {
        $model = PermissionFactory::new()->createOne();

        $testResponse = $this->injectId($model->id, replace: '{permission_id}')->makeCall();

        $testResponse->assertOk();

        $responseContent = $this->getResponseContentObject();
        $this->assertSame($model->name, $responseContent->data->name);
    }

    public function testFindNonExistingPermission(): void
    {
        $invalidId = 7777777;

        $testResponse = $this->injectId($invalidId, replace: '{permission_id}')->makeCall();

        $testResponse->assertNotFound();
    }
}
