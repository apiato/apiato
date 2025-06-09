<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisNotMatchListThat;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisNotMatchListThat::class)]
final class ThisNotMatchListThatTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);
        TestUserFactory::new()->create(['name' => 'C']);
        TestUserFactory::new()->create(['name' => 'D']);

        $repository = app(TestUserRepository::class);
        $thisNotMatchListThat = new ThisNotMatchListThat('name', ['A', 'B']);
        $repository->pushCriteria($thisNotMatchListThat);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals(['C', 'D'], $result->pluck('name')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithEmptyList(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $thisNotMatchListThat = new ThisNotMatchListThat('name', []);
        $repository->pushCriteria($thisNotMatchListThat);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals(['A', 'B'], $result->pluck('name')->toArray());
    }
}
