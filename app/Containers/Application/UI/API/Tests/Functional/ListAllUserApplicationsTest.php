<?php

namespace App\Containers\Application\UI\API\Tests\Functional;

use App\Containers\Application\Models\Application;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;

/**
 * Class ListAllUserApplicationsTest
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ListAllUserApplicationsTest extends TestCase
{

    private $endpoint = '/apps';

    public function testListAllUserApplications_()
    {
        $user = $this->registerAndLoginTestingDeveloper();

        factory(Application::class, 2)->create();

        factory(Application::class, 4)->create([
            'user_id' => $user->id,
        ]);

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'get');

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '200');

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals(4, count($responseObject->data));
    }

}
