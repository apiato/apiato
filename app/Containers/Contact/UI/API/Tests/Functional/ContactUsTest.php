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
        $visitor = $this->getVisitor();

        $headers['visitor-id'] = $visitor->visitor_id;

        $data = [
            'email'   => 'mahmoud@zalt.me',
            'message' => 'I just want to tell you this App is awesome.',
            'name'    => 'Cool User',
            'subject' => 'Thank you RewardFox',
        ];


        // TODO NOW:
        // 3. RUN ALL TESTS AND FIX EVERYTHING
        // 4. MERGE WITH HELLO API
        // 5. PUSH HELLO API + MARKETPLACE + REWARD FIX
        // 6. MOVE TO ANOTHER TASK...

        // mock sending emails
        Mail::shouldReceive('queue')->once()->andReturn('true');

        Config::set('mail.to.address', 'mahmoudz.me@gmail.com');
        Config::set('mail.to.name', 'Mahmoud');

        $response = $this->apiCall($this->endpoint, 'post', $data, false, $headers);

        $this->assertEquals($response->getStatusCode(), '202');

        $this->assertResponseContainKeyValue(['message' => 'Message sent Successfully.'], $response);
    }

}
