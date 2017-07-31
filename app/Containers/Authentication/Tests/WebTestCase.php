<?php

namespace App\Containers\Authentication\Tests;

use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;

/**
 * Class WebTestCase
 *
 * Container Web TestCase class. Use this class to put your Web container specific tests helper functions.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WebTestCase extends ShipTestCase
{
    // overrides the default subDomain in the base URL
    protected $subDomain = 'admin';

    public function setUp()
    {
        // change the API_PREFIX for web tests
        putenv("API_PREFIX=api");

        parent::setUp();
    }

    public function tearDown()
    {
        // revert the API_PREFIX variable to null to avoid effects on other test
        putenv("API_PREFIX=");

        parent::tearDown();
    }
}
