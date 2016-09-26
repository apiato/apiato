<?php

namespace App\Containers\Countries\Tasks;

use App\Containers\Countries\Data\Repositories\CountryRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindCountryTaskByIso.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindCountryTaskByIso extends Task
{

    /**
     * @var  \App\Containers\Countries\Data\Repositories\CountryRepository
     */
    private $countryRepository;

    /**
     * FindCountryTaskByIso constructor.
     *
     * @param \App\Containers\Countries\Data\Repositories\CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param $iso
     *
     * @return  mixed
     */
    public function run($iso)
    {
        return $this->countryRepository->findByField('iso_3166_2', $iso)->first();
    }

}
