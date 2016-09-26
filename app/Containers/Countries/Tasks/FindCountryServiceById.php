<?php

namespace App\Containers\Countries\Tasks;

use App\Containers\Countries\Data\Repositories\CountryRepository;
use App\Port\Task\Abstracts\Task;

/**
 * Class FindCountryTaskById.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindCountryTaskById extends Task
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
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        return $this->countryRepository->find($id);
    }

}
