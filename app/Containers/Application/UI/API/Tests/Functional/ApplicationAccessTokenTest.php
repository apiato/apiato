<?php

namespace App\Containers\Application\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

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
        $user = $this->registerAndLoginTestingDeveloper();

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
