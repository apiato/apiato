<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisLikeThatCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisLikeThatCriteria::class)]
final class ThisLikeThatCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $modelA = TestUserFactory::new()->create(['name' => 'ABCDEF']);
        $modelB = TestUserFactory::new()->create(['name' => 'EFGHIJ']);
        TestUserFactory::new()->create(['name' => 'PQRSTU']);
        TestUserFactory::new()->create(['name' => 'JKLMNO']);

        $repository = app(TestUserRepository::class);
        $thisLikeThatCriteria = new ThisLikeThatCriteria('name', '*EF*');
        $repository->pushCriteria($thisLikeThatCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelB->id], $result->pluck('id')->toArray());
    }
}
