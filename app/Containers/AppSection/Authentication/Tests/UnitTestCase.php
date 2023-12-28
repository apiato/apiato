<?php

namespace App\Containers\AppSection\Authentication\Tests;

class UnitTestCase extends ContainerTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->createPasswordGrantClient('clientId', 'clientSecret');
    }
}
