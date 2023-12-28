<?php

namespace App\Containers\AppSection\Authentication\Tests;

class UnitTestCase extends ContainerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->createPasswordGrantClient('100', 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX');
        $this->createOAuthTestingKeys();
    }
}
