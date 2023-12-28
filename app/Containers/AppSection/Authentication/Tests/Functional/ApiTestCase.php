<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional;

use App\Containers\AppSection\Authentication\Tests\FunctionalTestCase;

class ApiTestCase extends FunctionalTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->createPasswordGrantClient('clientId', 'clientSecret');
    }
}
