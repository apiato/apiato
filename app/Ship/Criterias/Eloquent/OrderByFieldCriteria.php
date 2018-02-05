<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class OrderByFieldCriteria
 *
 * @package App\Ship\Criterias\Eloquent
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class OrderByFieldCriteria extends Criteria
{

    private $field;
    private $sortOrder;

    /**
     * OrderByFieldCriteria constructor.
     *
     * @param string $field The field to be sorted
     * @param string $sortOrder the sort direction (asc or desc)
     */
    public function __construct($field, $sortOrder)
    {
        $this->field = $field;

        $sortOrder = Str::lower($sortOrder);
        $availableDirections = [
            'asc',
            'desc',
        ];

        // check if the value is available, otherwise set "default" sort order to ascending!
        if (! array_search($sortOrder, $availableDirections)) {
            $sortOrder = 'asc';
        }

        $this->sortOrder = $sortOrder;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->orderBy($this->field, $this->sortOrder);
    }

}
