<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\CountCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CountCriteria::class)]
final class CountCriteriaTest extends ShipTestCase
{
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'A']);
        TestUserFactory::new()->create(['name' => 'B']);

        $repository = app(TestUserRepository::class);
        $countCriteria = new CountCriteria('name');
        $repository->pushCriteria($countCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);

        $aResult = $result->where('name', 'A')->first();
        $bResult = $result->where('name', 'B')->first();

        self::assertEquals(2, $aResult->total_count);
        self::assertEquals(1, $bResult->total_count);
    }
}
