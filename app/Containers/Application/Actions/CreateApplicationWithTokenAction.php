<?php

namespace App\Containers\Application\Actions;

use App\Containers\Application\Tasks\CreateApplicationTask;
use App\Containers\Application\Tasks\GetApplicationClaimsTask;
use App\Containers\Application\Tasks\SetApplicationTokenTask;
use App\Containers\Authentication\Tasks\GenerateTokenFromClaimsTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class CreateApplicationWithTokenAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateApplicationWithTokenAction extends Action
{

    /**
     * @var  \App\Containers\Application\Tasks\CreateApplicationTask
     */
    private $createApplicationTask;

    /**
     * @var  \App\Containers\Application\Tasks\GenerateTokenFromClaimsTask
     */
    private $generateTokenFromClaimsTask;

    /**
     * @var  \App\Containers\Application\Tasks\GetApplicationClaimsTask
     */
    private $getApplicationClaimsTask;

    /**
     * @var  \App\Containers\Application\Actions\SetApplicationTokenTask|\App\Containers\Application\Tasks\SetApplicationTokenTask
     */
    private $setApplicationTokenTask;

    /**
     * GenerateApplicationTokenAction constructor.
     *
     * @param \App\Containers\Application\Tasks\CreateApplicationTask          $createApplicationTask
     * @param \App\Containers\Authentication\Tasks\GenerateTokenFromClaimsTask $generateTokenFromClaimsTask
     * @param \App\Containers\Application\Tasks\GetApplicationClaimsTask       $getApplicationClaimsTask
     * @param \App\Containers\Application\Tasks\SetApplicationTokenTask        $setApplicationTokenTask
     */
    public function __construct(
        CreateApplicationTask $createApplicationTask,
        GenerateTokenFromClaimsTask $generateTokenFromClaimsTask,
        GetApplicationClaimsTask $getApplicationClaimsTask,
        SetApplicationTokenTask $setApplicationTokenTask
    ) {
        $this->createApplicationTask = $createApplicationTask;
        $this->generateTokenFromClaimsTask = $generateTokenFromClaimsTask;
        $this->getApplicationClaimsTask = $getApplicationClaimsTask;
        $this->setApplicationTokenTask = $setApplicationTokenTask;
    }

    /**
     * @param $applicationName
     * @param $userId
     *
     * @return  \App\Containers\Application\Models\Application|mixed
     */
    public function run($applicationName, $userId)
    {
        $application = $this->createApplicationTask->run($applicationName, $userId);

        $customClaims = $this->getApplicationClaimsTask->run($application);

        $token = $this->generateTokenFromClaimsTask->run($customClaims);

        $application = $this->setApplicationTokenTask->run($application, $token);

        return $application;
    }
}
