<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisEqualThatCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisEqualThatCriteria::class)]
final class ThisEqualThatCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'B']);
        $modelA = TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $thisEqualThatCriteria = new ThisEqualThatCriteria('name', 'A');
        $repository->pushCriteria($thisEqualThatCriteria);

        $result = $repository->all();

        self::assertCount(1, $result);
        self::assertSame($modelA->id, $result->first()->id);
    }
}
