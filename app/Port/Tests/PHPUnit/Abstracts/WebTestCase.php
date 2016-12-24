<?php

namespace App\Port\Tests\PHPUnit\Abstracts;

class WebTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->baseUrl = env('WEB_FULL_URL');
    }
}
