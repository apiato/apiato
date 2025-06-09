<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderByCreationDateDescendingCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(OrderByCreationDateDescendingCriteria::class)]
final class OrderByCreationDateDescendingCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['created_at' => now()]);
        $modelA = TestUserFactory::new()->create(['created_at' => now()->subDay()]);
        $modelC = TestUserFactory::new()->create(['created_at' => now()->addDay()]);

        $repository = app(TestUserRepository::class);
        $orderByCreationDateDescendingCriteria = new OrderByCreationDateDescendingCriteria();
        $repository->pushCriteria($orderByCreationDateDescendingCriteria);

        $result = $repository->all();

        self::assertSame($modelC->id, $result->first()->id);
        self::assertSame($modelB->id, $result->get(1)->id);
        self::assertSame($modelA->id, $result->last()->id);
    }
}
