<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisWhereOrWhereThatCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisWhereOrWhereThatCriteria::class)]
final class ThisWhereOrWhereThatCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithMultipleFields(): void
    {
        $userA = TestUserFactory::new()->create(['name' => 'A', 'email' => 'a@test.com']);
        $userB = TestUserFactory::new()->create(['name' => 'B', 'email' => 'b@test.com']);
        $userC = TestUserFactory::new()->create(['name' => 'C', 'email' => 'c@test.com']);

        $repository = app(TestUserRepository::class);
        $thisWhereOrWhereThatCriteria = new ThisWhereOrWhereThatCriteria(
            fields: ['name', 'email'],
            values: ['A', 'b@test.com']
        );
        $repository->pushCriteria($thisWhereOrWhereThatCriteria);

        $result = $repository->all();

        // Should match users with name=A OR email=b@test.com
        self::assertCount(2, $result);
        self::assertContains($userA->id, $result->pluck('id')->toArray());
        self::assertContains($userB->id, $result->pluck('id')->toArray());
        self::assertNotContains($userC->id, $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSingleField(): void
    {
        $userA = TestUserFactory::new()->create(['name' => 'A', 'email' => 'a@test.com']);
        TestUserFactory::new()->create(['name' => 'B', 'email' => 'b@test.com']);
        TestUserFactory::new()->create(['name' => 'C', 'email' => 'c@test.com']);

        $repository = app(TestUserRepository::class);
        $thisWhereOrWhereThatCriteria = new ThisWhereOrWhereThatCriteria(
            fields: ['name'],
            values: ['A']
        );
        $repository->pushCriteria($thisWhereOrWhereThatCriteria);

        $result = $repository->all();

        // Should match users with name=A only
        self::assertCount(1, $result);
        self::assertContains($userA->id, $result->pluck('id')->toArray());
    }
}
