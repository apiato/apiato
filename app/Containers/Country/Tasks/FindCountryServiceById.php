<?php

namespace App\Containers\Country\Tasks;

use App\Containers\Country\Data\Repositories\CountryRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindCountryTaskById.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindCountryTaskById extends Task
{

    /**
     * @var  \App\Containers\Country\Data\Repositories\CountryRepository
     */
    private $countryRepository;

    /**
     * FindCountryTaskByIso constructor.
     *
     * @param \App\Containers\Country\Data\Repositories\CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        return $this->countryRepository->find($id);
    }

}
