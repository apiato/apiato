<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisBetweenDatesCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisBetweenDatesCriteria::class)]
final class ThisBetweenDatesCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $todayModels = TestUserFactory::new()->count(1)->create(['created_at' => now()]);
        TestUserFactory::new()->count(2)->create(['created_at' => now()->subDays(2)]);
        TestUserFactory::new()->count(3)->create(['created_at' => now()->addDays(2)]);

        $repository = app(TestUserRepository::class);
        $thisBetweenDatesCriteria = new ThisBetweenDatesCriteria(
            'created_at',
            now()->toImmutable()->subDay(),
            now()->toImmutable()->addDay(),
        );
        $repository->pushCriteria($thisBetweenDatesCriteria);

        $result = $repository->all();

        self::assertCount(1, $result);
        self::assertSame($todayModels->first()->id, $result->first()->id);
    }
}
