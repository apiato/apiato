<?php

namespace App\Containers\Tracker\UI\API\Tests\Functional;

use App\Containers\Tracker\Models\TimeTracker;
use App\Containers\User\Models\User;
use App\Port\Tests\PHPUnit\Abstracts\TestCase;
use Carbon\Carbon;

/**
 * Class TrackCloseTest
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class TrackCloseTest extends TestCase
{

    private $endpoint = '/track/close';

    public function testTrackClose()
    {
        $visitorId = str_random('40');

        $visitor = new User();
        $visitor->visitor_id = $visitorId;
        $visitor->save();

        $headers['visitor-id'] = $visitorId;

        $timeTracker = new TimeTracker();
        $timeTracker->open_at = Carbon::yesterday();
        $timeTracker->status = TimeTracker::PENDING;
        $timeTracker->user()->associate($visitor);
        $timeTracker->save();

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', [], true, $headers);

        // assert response status is correct
        $this->assertEquals($response->getStatusCode(), '202');

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($responseObject->message, 'Session (close) Tracked Successfully.');

        $this->seeInDatabase('time_tracker', ['status' => TimeTracker::SUCCEEDED]);

    }

}
