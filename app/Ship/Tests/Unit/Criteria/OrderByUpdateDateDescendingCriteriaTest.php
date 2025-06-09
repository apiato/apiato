<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderByUpdateDateDescendingCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(OrderByUpdateDateDescendingCriteria::class)]
final class OrderByUpdateDateDescendingCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $modelB = TestUserFactory::new()->create(['updated_at' => now()]);
        $modelA = TestUserFactory::new()->create(['updated_at' => now()->subDay()]);
        $modelC = TestUserFactory::new()->create(['updated_at' => now()->addDay()]);

        $repository = app(TestUserRepository::class);
        $orderByUpdateDateDescendingCriteria = new OrderByUpdateDateDescendingCriteria();
        $repository->pushCriteria($orderByUpdateDateDescendingCriteria);

        $result = $repository->all();

        self::assertSame($modelC->id, $result->first()->id);
        self::assertSame($modelB->id, $result->get(1)->id);
        self::assertSame($modelA->id, $result->last()->id);
    }
}
