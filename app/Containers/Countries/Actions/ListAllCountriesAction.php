<?php

namespace App\Containers\Countries\Actions;

use App\Containers\Countries\Data\Repositories\CountryRepository;
use App\Port\Action\Abstracts\Action;
use App\Port\Criterias\Eloquent\OrderByNameCriteria;

/**
 * Class ListAllCountriesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListAllCountriesAction extends Action
{

    /**
     * ListAllCountriesAction constructor.
     *
     * @param \App\Containers\Countries\Data\Repositories\CountryRepository $countryRepository
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
