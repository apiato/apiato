<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\SelectTableCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(SelectTableCriteria::class)]
final class SelectTableCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithSpecificFields(): void
    {
        TestUserFactory::new()->create(['name' => 'A', 'email' => 'a@test.com']);

        $repository = app(TestUserRepository::class);
        $selectTableCriteria = new SelectTableCriteria(['id', 'name']);
        $repository->pushCriteria($selectTableCriteria);

        $result = $repository->all()->first()->toArray();

        self::assertArrayHasKey('id', $result);
        self::assertArrayHasKey('name', $result);
        self::assertArrayNotHasKey('email', $result);
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithDefaultFields(): void
    {
        TestUserFactory::new()->create(['name' => 'A', 'email' => 'a@test.com']);

        $repository = app(TestUserRepository::class);
        $selectTableCriteria = new SelectTableCriteria();
        $repository->pushCriteria($selectTableCriteria);

        $result = $repository->all()->first()->toArray();

        self::assertArrayHasKey('id', $result);
        self::assertArrayHasKey('name', $result);
        self::assertArrayHasKey('email', $result);
    }
}
