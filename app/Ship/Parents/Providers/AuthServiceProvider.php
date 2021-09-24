<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\AuthProvider as AbstractAuthProvider;

/**
 * Class ShipAuthServiceProvider
 *
 * A.K.A. App\Providers\AuthServiceProvider.php
 */
abstract class AuthServiceProvider extends AbstractAuthProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];
}
