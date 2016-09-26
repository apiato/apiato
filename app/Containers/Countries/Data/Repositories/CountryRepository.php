<?php

namespace App\Containers\Countries\Data\Repositories;

use App\Containers\Countries\Models\Country;
use App\Port\Repository\Abstracts\Repository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class CountryRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountryRepository extends Repository implements CacheableInterface {

    use CacheableRepository;

    // cache the query result of all() (getting all countries) for 1 day   <when caching is enabled>
    protected $cacheMinutes = 1440; // 1 day
    protected $cacheOnly = ['all'];


    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Country::class;
    }
}
