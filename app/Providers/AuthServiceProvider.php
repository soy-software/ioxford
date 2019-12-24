<?php

namespace iouesa\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use iouesa\Models\Paralelo;
use iouesa\Models\Periodo;
use iouesa\Policies\ParaleloPolicy;
use iouesa\Policies\PeriodoPolicy;
use iouesa\Policies\UserPolicy;
use iouesa\User;

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
