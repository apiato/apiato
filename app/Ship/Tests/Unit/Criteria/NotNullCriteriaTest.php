<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\NotNullCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(NotNullCriteria::class)]
final class NotNullCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => null]);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $notNullCriteria = new NotNullCriteria('name');
        $repository->pushCriteria($notNullCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertNotContains(null, $result->pluck('name')->toArray());
        self::assertEquals(['A', 'B'], $result->pluck('name')->toArray());
    }
}
