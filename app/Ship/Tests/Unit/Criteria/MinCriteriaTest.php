<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\MinCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(MinCriteria::class)]
final class MinCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithoutAdditionalFields(): void
    {
        TestUserFactory::new()->create(['age' => 30]);
        TestUserFactory::new()->create(['age' => 25]);
        TestUserFactory::new()->create(['age' => 40]);

        $repository = app(TestUserRepository::class);
        $minCriteria = new MinCriteria('age', 'min_age', []);
        $repository->pushCriteria($minCriteria);

        $result = $repository->all()->first();

        self::assertEquals(25, $result->min_age);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithAdditionalFields(): void
    {
        TestUserFactory::new()->create(['name' => 'A', 'age' => 30]);
        TestUserFactory::new()->create(['name' => 'B', 'age' => 25]);
        TestUserFactory::new()->create(['name' => 'C', 'age' => 40]);

        $repository = app(TestUserRepository::class);
        $minCriteria = new MinCriteria('age', 'min_age', ['name']);
        $repository->pushCriteria($minCriteria);

        $result = $repository->all();

        self::assertCount(3, $result);

        $resultB = $result->where('name', 'B')->first();
        self::assertNotNull($resultB);
        self::assertEquals(25, $resultB->min_age);
        self::assertEquals('B', $resultB->name);
    }
}
