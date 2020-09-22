<?php

namespace App\Providers;

use App\Services\Common\Infrastructure\InfrastructureService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share("is_ipuntracked", InfrastructureService::is_ipuntracked());
    }
}
