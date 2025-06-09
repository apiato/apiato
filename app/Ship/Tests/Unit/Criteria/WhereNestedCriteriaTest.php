<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WhereNestedCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WhereNestedCriteria::class)]
final class WhereNestedCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        $modelA = TestUserFactory::new()->create(['name' => 'A', 'age' => 25]);
        $modelB = TestUserFactory::new()->create(['name' => 'B', 'age' => 30]);
        TestUserFactory::new()->create(['name' => 'C', 'age' => 20]);
        TestUserFactory::new()->create(['name' => 'D', 'age' => 35]);

        $repository = app(TestUserRepository::class);

        // Create a nested where condition: name = 'A' OR (name = 'B' AND age = 30)
        $whereNestedCriteria = new WhereNestedCriteria(static function (Builder $query): void {
            $query->where('name', 'A')
                  ->orWhere(static function (Builder $subQuery): void {
                      $subQuery->where('name', 'B')
                              ->where('age', 30);
                  });
        });

        $repository->pushCriteria($whereNestedCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelB->id], $result->pluck('id')->toArray());
    }

    /**
     * @throws RepositoryException
     */
    public function testCriteriaWithComplexNesting(): void
    {
        $modelA = TestUserFactory::new()->create(['name' => 'A', 'age' => 25, 'active' => true]);
        TestUserFactory::new()->create(['name' => 'B', 'age' => 30, 'active' => true]);
        TestUserFactory::new()->create(['name' => 'C', 'age' => 20, 'active' => false]);
        $modelD = TestUserFactory::new()->create(['name' => 'D', 'age' => 35, 'active' => false]);

        $repository = app(TestUserRepository::class);

        // Create a complex nested condition:
        // (name = 'A' AND active = true) OR (name = 'D' AND active = false)
        $whereNestedCriteria = new WhereNestedCriteria(static function (Builder $query): void {
            $query->where(static function (Builder $subQuery): void {
                $subQuery->where('name', 'A')
                        ->where('active', true);
            })->orWhere(static function (Builder $subQuery): void {
                $subQuery->where('name', 'D')
                        ->where('active', false);
            });
        });

        $repository->pushCriteria($whereNestedCriteria);

        $result = $repository->all();

        self::assertCount(2, $result);
        self::assertEquals([$modelA->id, $modelD->id], $result->pluck('id')->toArray());
    }
}
