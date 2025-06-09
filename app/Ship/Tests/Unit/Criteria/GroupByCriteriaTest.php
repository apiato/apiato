<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\GroupByCriteria;
use App\Ship\Criteria\SelectTableCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(GroupByCriteria::class)]
final class GroupByCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $selectTableCriteria = new SelectTableCriteria(['name']);
        $groupByCriteria = new GroupByCriteria('name');
        $repository->pushCriteria($selectTableCriteria);
        $repository->pushCriteria($groupByCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals(['A', 'B'], $result->pluck('name')->toArray());
    }
}
