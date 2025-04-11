<?php

namespace App\Providers;


// use Illuminate\Support\ServiceProvider;

use App\Models\Job;
use App\Policies\JobPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// <-- can use: -->
// use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        // connect the job model to the job policy
        Job::class => JobPolicy::class,
    ];


    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // global constraints ...
        // part of the service provider we brought in 
        // using as serviceProvider
        $this->registerPolicies();
    }
}
