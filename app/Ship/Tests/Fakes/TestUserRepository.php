<?php

declare(strict_types=1);

namespace App\Ship\Tests\Fakes;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TestUserRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'name' => 'ilike',
    ];

    public function model(): string
    {
        return TestUser::class;
    }

    /**
     * Public method to apply criteria and get query for testing.
     */
    public function applyCriteriaAndGetQuery(): Model|Builder
    {
        $this->applyCriteria();

        $model = $this->model;

        $this->resetScope();
        $this->resetCriteria();

        return $model;
    }
}
