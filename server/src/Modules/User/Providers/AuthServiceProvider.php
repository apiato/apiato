<?php

namespace Mega\Modules\User\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Mega\Modules\User\Models\User;
use Mega\Modules\User\Policies\UserPolicy;

/**
 * Class AuthServiceProvider.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AuthServiceProvider extends ServiceProvider
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
