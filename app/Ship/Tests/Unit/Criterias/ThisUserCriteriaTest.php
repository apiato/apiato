<?php

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\ThisUserCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(ThisUserCriteria::class)]
final class ThisUserCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $model2 = TestUserFactory::new()->create(['user_id' => '2']);
        $model1 = TestUserFactory::new()->create(['user_id' => '1']);
        $model3 = TestUserFactory::new()->create(['user_id' => '3']);

        $repository = app(TestUserRepository::class);
        $criteria = new ThisUserCriteria(1);
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertSame(1, $result->count());
        $this->assertSame($model1->id, $result->first()->id);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUsersTable();
    }
}
