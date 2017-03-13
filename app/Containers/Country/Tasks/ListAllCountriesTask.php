<?php

namespace App\Containers\Country\Tasks;

use App\Containers\Country\Data\Repositories\CountryRepository;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Features\Criterias\Eloquent\OrderByNameCriteria;

/**
 * Class ListAllCountriesTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllCountriesTask extends Task
{
    /**
     * @var \App\Containers\Country\Data\Repositories\CountryRepository
     */
    private $countryRepository;

    /**
     * ListAllCountriesTask constructor.
     *
     * @param \App\Containers\Country\Data\Repositories\CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        $this->countryRepository->pushCriteria(new OrderByNameCriteria());

        $countryRequests = $this->countryRepository->all();

        return $countryRequests;
    }

}
