<?php

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\IsNullCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(IsNullCriteria::class)]
final class IsNullCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $modelsWithNull = TestUserFactory::new()->count(3)->create(['published' => null]);
        $modelsWithNotNull = TestUserFactory::new()->count(2)->create(['published' => 'something']);

        $repository = app(TestUserRepository::class);
        $criteria = new IsNullCriteria('published');
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertCount(3, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUsersTable();
    }
}
