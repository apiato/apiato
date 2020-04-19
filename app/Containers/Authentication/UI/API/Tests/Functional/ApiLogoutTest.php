<?php

namespace App\Containers\Authentication\UI\API\Tests\Functional;

use App\Containers\Authentication\Tests\ApiTestCase;

/**
 * Class ApiLogoutTest
 *
 * @group authorization
 * @group api
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ApiLogoutTest extends ApiTestCase
{

    protected $endpoint = 'delete@v1/logout';

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * @test
     */
    public function testLogout()
    {
        $response = $this->makeCall([], [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImUxODk3NjU3YTVlZWQxMDkyMThlZjVmOThl
           MGMzMzg5OTQ3MzNkZDYyZWM0Nzk5Y2E0NWQ1NjUyYmQ0NjFiZWUzZWQ5YjU1ZjNmMGE2NTA3In0.eyJhdWQiOiIyIiwianRpIjoiZTE4OTc
           2NTdhNWVlZDEwOTIxOGVmNWY5OGUwYzMzODk5NDczM2RkNjJlYzQ3OTljYTQ1ZDU2NTJiZDQ2MWJlZTNlZDliNTVmM2YwYTY1MDciLCJpYXQ
           iOjE1MTI4NzgzNjMsIm5iZiI6MTUxMjg3ODM2MywiZXhwIjoxODI4MjM4MzYyLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.q1MXp5odmhlurbG
           a-Ft8m3U3DA6CetCCk23ap8aqY2z_pTpfugqh6vqCe-8iVE9cJPjoMifWAFQ4UeTy_Y0PRurRh7o8_jCqclQ-1IudPmggayyS0kBYoHRRHT-
           2wzdpIw7jDLg589HV2HClbBq5IwYvLw3yqRTGmEgTFEJ2jCnT58A2sAuRuJ95k3FjuyBZ33dvoFelotMOSG0wR-2H7JjWRi4SL0XEZikoIlT
           4aAFC8Xa8TVt8ZsfQxDjc9Uyg6HBGTQo5JZNZgSje_0K4DyrHzW3tbWJ2CxLQjTPpWyEcVGavZ55UEjGJXr4JmFAZMCEyIfq0xop1ZnIOiIr
           mI1ajopXwcTTo0K8ymDDCAgB8JbGQTcGGSZe2VHJCXXaQJvesIlvke6ZvsoKwUqphpe99Qi67e3TA0_uDK8_u-Bv4lew95lg3IXBMKvfXvi1
           7rEDvO23uClDWnZUhHKgqtPhO8oG7A1hFR8arLN1lEKrP44zO5470cD6_Pw7Ngi1coJeG5jXmtRb9gCpksdYQBB5csURioYSZuHNZQBGVWZV
           zlURPWvgtSd_aL646KmMmy64L4MA1QXsqXzzuLULGbcSntB8N-2XcogdTFe0ZG6RL8UzcArZx0Xur8CCi01UuPkBCnv5R4hxIjsQDkmFIDmr
           Cyo2VuoVyrlxWIgsTm04'
        ]);

        $response->assertStatus(202);

        $this->assertResponseContainKeyValue([
            'message' => 'Token revoked successfully.',
        ]);

    }

}
