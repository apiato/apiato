<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\OrderByUpdateDateAscendingCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(OrderByUpdateDateAscendingCriteria::class)]
final class OrderByUpdateDateAscendingCriteriaTest extends ShipTestCase
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
        $orderByUpdateDateAscendingCriteria = new OrderByUpdateDateAscendingCriteria();
        $repository->pushCriteria($orderByUpdateDateAscendingCriteria);

        $result = $repository->all();

        self::assertSame($modelA->id, $result->first()->id);
        self::assertSame($modelB->id, $result->get(1)->id);
        self::assertSame($modelC->id, $result->last()->id);
    }
}
