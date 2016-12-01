<?php

namespace App\Containers\Application\Data\Repositories;

use App\Containers\Application\Models\Application;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class ApplicationRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApplicationRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Application::class;
    }
}
