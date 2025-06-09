<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisMatchListThat;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisMatchListThat::class)]
final class ThisMatchListThatTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        TestUserFactory::new()->create(['name' => 'C']);
        TestUserFactory::new()->create(['name' => 'D']);

        $repository = app(TestUserRepository::class);
        $thisMatchListThat = new ThisMatchListThat('name', ['A', 'B']);
        $repository->pushCriteria($thisMatchListThat);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelB->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithEmptyList(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $thisMatchListThat = new ThisMatchListThat('name', []);
        $repository->pushCriteria($thisMatchListThat);

        $result = $repository->all();

        self::assertCount(0, $result);
    }
}
