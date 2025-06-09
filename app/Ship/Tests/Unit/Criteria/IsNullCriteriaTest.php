<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\IsNullCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(IsNullCriteria::class)]
final class IsNullCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->count(3)->create(['published' => null]);
        TestUserFactory::new()->count(2)->create(['published' => 'something']);

        $repository = app(TestUserRepository::class);
        $isNullCriteria = new IsNullCriteria('published');
        $repository->pushCriteria($isNullCriteria);

        $result = $repository->all();

        self::assertCount(3, $result);
    }
}
