<?php

namespace App\Containers\Country\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CountryRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountryRepository extends Repository
{

    // cache the query result of all() (getting all countries) for 1 day   <when caching is enabled>
    protected $cacheMinutes = 1440; // 1 day

    protected $cacheOnly = ['all'];

    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

}
