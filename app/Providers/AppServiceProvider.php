<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\CarbonInterval;

class AppServiceProvider extends ServiceProvider
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
     */
    public function boot(): void
    {
        Passport::$keyPath = storage_path(); // cấu hình đường dẫn mặc định

    // Thêm cấu hình nếu cần
        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Passport::tokensExpireIn(CarbonInterval::days(15));
        Passport::refreshTokensExpireIn(CarbonInterval::days(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

    }

    public function register(): void
    {
        //
    }

    public function registerPolicies(): void{
    
    }
}
