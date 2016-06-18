<?php

namespace App\Containers\User\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Containers\User\Models\User;
use App\Containers\User\Policies\UserPolicy;

/**
 * Class PoliciesServiceProvider.
 *
 * This Service Provider is designed to map the policies to their models.
 * Must be manually added to the list of extra service providers in the
 * modules config file in order to get registered in the framework.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PoliciesServiceProvider extends ServiceProvider
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
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //
    }
}
