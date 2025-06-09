<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\CreatedTodayCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(CreatedTodayCriteria::class)]
final class CreatedTodayCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->count(5)->create(['created_at' => now()->addDay()]);
        TestUserFactory::new()->count(2)->create(['created_at' => now()->subDay()]);
        TestUserFactory::new()->count(1)->create(['created_at' => now()->addDays(2)]);

        $repository = app(TestUserRepository::class);
        $createdTodayCriteria = new CreatedTodayCriteria();
        $repository->pushCriteria($createdTodayCriteria);

        $result = $repository->all();

        self::assertCount(6, $result);
    }
}
