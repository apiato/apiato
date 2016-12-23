<?php

namespace App\Containers\Contact\UI\API\Tests\Functional;

use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use Illuminate\Support\Facades\Config;
use Mail;

/**
 * Class SampleTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ContactUsTest extends TestCase
{

    private $endpoint = '/contact';

    public function testContactUs()
    {
        $data = [
            'email'   => 'mahmoud@mail.me',
            'message' => 'I just want to tell you this App is awesome.',
            'name'    => 'Cool User',
            'subject' => 'Thank you RewardFox',
        ];

        // mock sending emails
        Mail::shouldReceive('queue')->once()->andReturn('true');

        Config::set('mail.to.address', 'mail@gmail.com');
        Config::set('mail.to.name', 'Mahmoud');

        $response = $this->apiCall($this->endpoint, 'post', $data, false);

        $this->assertEquals($response->getStatusCode(), '202');

        $this->assertResponseContainKeyValue(['message' => 'Message sent Successfully.'], $response);
    }

}
