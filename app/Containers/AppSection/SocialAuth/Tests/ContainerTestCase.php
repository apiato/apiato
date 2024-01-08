<?php

namespace App\Containers\AppSection\SocialAuth\Tests;

use App\Ship\Parents\Tests\PhpUnit\TestCase as ParentTestCase;
use DG\BypassFinals;

class ContainerTestCase extends ParentTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        BypassFinals::enable();
    }
}
