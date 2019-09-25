<?php

namespace ioxford\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use ioxford\Models\Paralelo;
use ioxford\Models\Periodo;
use ioxford\Policies\ParaleloPolicy;
use ioxford\Policies\PeriodoPolicy;
use ioxford\Policies\UserPolicy;
use ioxford\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class=>UserPolicy::class,
        Periodo::class=>PeriodoPolicy::class,
        Paralelo::class=>ParaleloPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
