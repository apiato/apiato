<?php

namespace App\Containers\Application\UI\API\Tests\Functional;

use App\Containers\Application\Models\Application;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

/**
 * Class ApplicationAccessTokenTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApplicationAccessTokenTest extends TestCase
{

    private $endpoint = '/apps';

    public function testCreateApplicationWithToken_()
    {
        $user = $this->registerAndLoginTestingUser();

        $data = [
            'name' => 'My first App'
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        // assert response contain the data
        $this->assertResponseContainKeys(['application_token'], $response);
    }

}
