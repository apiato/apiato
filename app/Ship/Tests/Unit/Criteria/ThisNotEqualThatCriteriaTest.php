<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisNotEqualThatCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisNotEqualThatCriteria::class)]
final class ThisNotEqualThatCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        $modelB = TestUserFactory::new()->create(['name' => 'B']);
        $modelC = TestUserFactory::new()->create(['name' => 'C']);

        $repository = app(TestUserRepository::class);
        $thisNotEqualThatCriteria = new ThisNotEqualThatCriteria('name', 'A');
        $repository->pushCriteria($thisNotEqualThatCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelB->id, $modelC->id], $result->pluck('id')->toArray());
    }
}
