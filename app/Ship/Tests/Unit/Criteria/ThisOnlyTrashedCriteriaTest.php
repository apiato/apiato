<?php

declare(strict_types=1);

namespace App\Ship\Tests\Unit\Criteria;

use App\Ship\Criteria\ThisOnlyTrashedCriteria;
use App\Ship\Tests\Fakes\TestUserFactory;
use App\Ship\Tests\Fakes\TestUserRepository;
use App\Ship\Tests\ShipTestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\CoversClass;
use Prettus\Repository\Exceptions\RepositoryException;

#[CoversClass(ThisOnlyTrashedCriteria::class)]
final class ThisOnlyTrashedCriteriaTest extends ShipTestCase
{
    /**
     * @throws RepositoryException
     */
    public function testCriteria(): void
    {
        TestUserFactory::new()->create(['name' => 'Active']);
        $deletedUser = TestUserFactory::new()->create(['name' => 'Deleted']);

        $deletedUser->delete();

        $repository = app(TestUserRepository::class);
        $thisOnlyTrashedCriteria = new ThisOnlyTrashedCriteria();
        $repository->pushCriteria($thisOnlyTrashedCriteria);

        $result = $repository->all();

        self::assertCount(1, $result);
        self::assertEquals('Deleted', $result->first()->name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        if (Schema::hasColumn('test_users', 'deleted_at') === false) {
            Schema::table('test_users', static function (Blueprint $table): void {
                $table->softDeletes();
            });
        }
    }
}
