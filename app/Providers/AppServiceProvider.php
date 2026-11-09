<?php

namespace App\Providers;

use App\Support\PublicJobListing;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        View::composer('layouts.public-site', function ($view) {
            $view->with('enlistmentJobs', PublicJobListing::all());
        });
    }
}
