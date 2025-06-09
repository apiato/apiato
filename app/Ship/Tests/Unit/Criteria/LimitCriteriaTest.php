<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\LimitCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(LimitCriteria::class)]
final class LimitCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);
        TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $limitCriteria = new LimitCriteria(2);
        $repository->pushCriteria($limitCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);
    }
}
