<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
final class CreateRoleTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/roles';

    protected array $access = [
        'permissions' => 'manage-roles',
        'roles'       => null,
    ];

    public function testCreateRole(): void
    {
        $data = [
            'name'         => 'manager',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertCreated();

        $responseContent = $this->getResponseContentObject();
        $this->assertSame($data['name'], $responseContent->data->name);
    }

    public function testCreateRoleWithWrongName(): void
    {
        $data = [
            'name'         => 'includes Space',
            'display_name' => 'manager',
            'description'  => 'he manages things',
        ];

        $testResponse = $this->makeCall($data);

        $testResponse->assertUnprocessable();
        $testResponse->assertJson(
            static fn (AssertableJson $json): AssertableJson => $json->has('message')
                    ->has('errors')
                    ->where('errors.name.0', 'String should not contain space.'),
        );
    }

    public function testGivenHaveNoAccessCannotCreateRole(): void
    {
        $this->getTestingUserWithoutAccess();

        $testResponse = $this->makeCall();

        $testResponse->assertForbidden();
    }
}
