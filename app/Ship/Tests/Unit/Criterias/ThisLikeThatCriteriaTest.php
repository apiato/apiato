<?php

namespace App\Ship\Tests\Unit\Criterias;

use App\Ship\Criterias\ThisLikeThatCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('ship')]
#[CoversClass(ThisLikeThatCriteria::class)]
final class ThisLikeThatCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['name' => 'EFGHIJ']);
        $modelA = TestUserFactory::new()->create(['name' => 'ABCDEF']);
        $modelC = TestUserFactory::new()->create(['name' => 'PQRSTU']);
        $modelD = TestUserFactory::new()->create(['name' => 'JKLMNO']);

        $repository = app(TestUserRepository::class);
        $criteria = new ThisLikeThatCriteria('name', '*EF*');
        $repository->pushCriteria($criteria);

        $result = $repository->all();

        $this->assertSame(2, $result->count());
        $this->assertSame($modelB->id, $result->first()->id);
        $this->assertSame($modelA->id, $result->last()->id);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUsersTable();
    }
}
