<?php

namespace App\Providers;

use App\Models\Creator;
use App\Models\Review;
use App\Models\User;
use App\Policies\CreatorPolicy;
use App\Policies\Gates\Gates;
use App\Policies\Gates\SecretContenrGate;
use App\Policies\Gates\UpdateSettingsGate;
use App\Policies\Permission;
use App\Policies\ReviewPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Creator::class => CreatorPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerGates();

        Passport::routes();
        Passport::tokensCan([
            'see-orders' => 'See orders',
            'modify-orders' => 'Modify orders',
        ]);
    }

    private function registerGates()
    {
        Gate::define(Gates::VIEW_SECRET_CONTENT, [SecretContenrGate::class, 'view']);
        Gate::define(Gates::UPDATE_SETTINGS, [UpdateSettingsGate::class, 'update']);

//        Gate::before(function ($user, $ability) {
//            return $user->isAdmin();
//        });
    }
}
