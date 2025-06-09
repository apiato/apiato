<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisUserCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisUserCriteria::class)]
final class ThisUserCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['user_id' => 2]);
        $model = TestUserFactory::new()->create(['user_id' => 1]);
        TestUserFactory::new()->create(['user_id' => 3]);

        $repository = app(TestUserRepository::class);
        $thisUserCriteria = new ThisUserCriteria(1);
        $repository->pushCriteria($thisUserCriteria);

        $result = $repository->all();

        self::assertCount(1, $result);
        self::assertSame($model->id, $result->first()->id);
    }
}
