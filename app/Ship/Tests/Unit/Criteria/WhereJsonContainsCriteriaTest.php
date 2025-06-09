<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\WhereJsonContainsCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(WhereJsonContainsCriteria::class)]
final class WhereJsonContainsCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create([
            'name'     => 'A',
            'metadata' => ['roles' => ['admin']],
        ]);

        TestUserFactory::new()->create([
            'name'     => 'B',
            'metadata' => ['roles' => ['user']],
        ]);

        TestUserFactory::new()->create([
            'name'     => 'C',
            'metadata' => ['roles' => ['admin', 'editor']],
        ]);

        $repository = app(TestUserRepository::class);
        $whereJsonContainsCriteria = new WhereJsonContainsCriteria('admin', 'metadata->roles');
        $repository->pushCriteria($whereJsonContainsCriteria);

        $query = $repository->applyCriteriaAndGetQuery();

        $actualSql = $query->toSql();

        $json = match (DB::getDriverName()) {
            'mysql'  => 'json_contains',
            'pgsql'  => 'jsonb',
            'sqlite' => 'json_each',
        };

        self::assertStringContainsString($json, $actualSql);

        $result = $repository->all();
        self::assertCount(2, $result);
        self::assertContains('A', $result->pluck('name')->toArray());
        self::assertContains('C', $result->pluck('name')->toArray());
        self::assertNotContains('B', $result->pluck('name')->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        if (Schema::hasColumn('test_users', 'metadata') === false) {
            Schema::table('test_users', static function (Blueprint $table): void {
                $table->json('metadata')->nullable();
            });
        }
    }
}
