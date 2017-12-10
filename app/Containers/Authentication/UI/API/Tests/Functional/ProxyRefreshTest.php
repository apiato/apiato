<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\Authentication\Tests\TestCase;

/**
 * Class ProxyRefreshTest
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ProxyRefreshTest extends TestCase
{

    protected $endpoint = 'post@v1/clients/web/admin/refresh';

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    public function testRefresh()
    {
        $data = [
            'refresh_token' => null
        ];

        $response = $this->makeCall($data);

        $response->assertStatus(401);

        // TODO: to be continue
    }

}
