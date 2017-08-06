<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\AuthProvider as AbstractAuthProvider;

/**
 * Class ShipAuthServiceProvider
 *
 * This class is provided by Laravel as default provider,
 * to register authorization policies.
 *
 * A.K.A App\Providers\AuthServiceProvider.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthProvider extends AbstractAuthProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

}
