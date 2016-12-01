<?php

namespace App\Containers\User\Providers;

use App\Port\Policy\Providers\PortAuthServiceProvider;
use App\Containers\User\Models\User;
use App\Containers\User\Policies\UserPolicy;

/**
 * Class AuthServiceProvider.
 *
 * This Provider is designed to map the policies to their models.
 * Must be manually added to the list of extra service providers in the
 * containers config file in order to get registered in the framework.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AuthServiceProvider extends PortAuthServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        parent::registerPolicies();
    }
}
