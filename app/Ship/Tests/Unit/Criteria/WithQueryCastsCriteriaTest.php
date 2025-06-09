<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WithQueryCastsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WithQueryCastsCriteria::class)]
final class WithQueryCastsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['age' => '25']);

        $repository = app(TestUserRepository::class);
        $withQueryCastsCriteria = new WithQueryCastsCriteria(['age' => 'integer']);
        $repository->pushCriteria($withQueryCastsCriteria);

        $result = $repository->first();
        self::assertIsInt($result->age);
        self::assertSame(25, $result->age);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithMultipleCasts(): void
    {
        TestUserFactory::new()->create([
            'age'    => '30',
            'active' => '1',
            'score'  => '4.5',
        ]);

        $repository = app(TestUserRepository::class);
        $withQueryCastsCriteria = new WithQueryCastsCriteria([
            'age'    => 'integer',
            'active' => 'boolean',
            'score'  => 'float',
        ]);
        $repository->pushCriteria($withQueryCastsCriteria);

        $result = $repository->first();
        self::assertIsInt($result->age);
        self::assertSame(30, $result->age);
        self::assertIsBool($result->active);
        self::assertTrue($result->active);
        self::assertIsFloat($result->score);
        self::assertSame(4.5, $result->score);
    }
}
