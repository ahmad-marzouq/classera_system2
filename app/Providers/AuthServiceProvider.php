<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
            \Route::post('/oauth/authorize', [
                'uses' => '\App\Http\Controllers\Passport\ApproveAuthorizationController@approve',
                'as' => 'passport.authorizations.approve',
                'middleware' => ['web'],
            ]);
            \Route::get('/oauth/authorize', [
                'uses' => '\App\Http\Controllers\Passport\AuthorizationController@authorize',
                'as' => 'passport.authorizations.authorize',
                'middleware' => ['web'],
            ]);
        }
    }
}
