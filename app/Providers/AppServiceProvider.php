<?php

namespace App\Providers;

use App\Models\Checksheets;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

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
        //Paginate
        Paginator::useBootstrap();

        View::composer([
            'Admin.Admin_Dashboard.Dashboard_Index',
            'Admin.Admin_Dashboard.Export.Export_Dashboard_Index',
            'Admin.Admin_Lists.List_Index',
            'Admin.Admin_Privillege.Privillege_Index',
            'User.User_Lists.List_Index'
        ], function ($view) {
            // Here, you can fetch the necessary data for your sidebar
            $checksheets = Checksheets::all();

            // Pass the data to the view
            $view->with(['checksheets' => $checksheets]);
        });
    }
}
