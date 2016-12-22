<?php

namespace App\Containers\Application\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class CreateApplicationWithTokenTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateApplicationWithTokenTest extends TestCase
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
        $this->assertEquals($response->getStatusCode(), '200');

        // assert response contain the data
        $this->assertResponseContainKeys(['token'], $response);
    }

}
