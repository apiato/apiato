<?php

namespace App\Containers\AppSection\Authentication\Tests\Functional;

use App\Containers\AppSection\Authentication\Tests\FunctionalTestCase;

class ApiTestCase extends FunctionalTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->createPasswordGrantClient('200', 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX');
        $this->createOAuthTestingKeys();
    }
}
