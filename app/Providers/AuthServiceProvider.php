<?php

namespace App\Providers;

use Carbon\Carbon;
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
//        Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(30));
//        //   dd(env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET')); 636AHArDK8RUdrT6wQNPLYRpNb6n77c20ySPS9Hl
//        Passport::enableImplicitGrant();
//    //    Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
//        Passport::routes();


        //
    }
}
