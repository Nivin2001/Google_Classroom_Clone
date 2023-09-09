<?php

namespace App\Providers;

use App\Models\post;
use App\Models\User;
use App\Models\Classwork;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        // Paginator::defaultView('vendor.pagination.bootstrap-5');
        // Paginator::defaultSimpleView('vendor.pagination.simle.bootstrap-5');




        Relation::enforceMorphMap([
            'post' => post::class,
         'classwork' => Classwork::class,

         'user' => User::class,
        ]);
    }
}
