<?php

namespace App\Providers;

use App\Models\ProfileIcon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
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
        View::composer('layouts.template', function ($view) {
            if (Auth::check()) {
                $nm_icon = ProfileIcon::where('id', '=', Auth::user()->profile_icon)->first()->nm_icon;
                return $view->with('nm_icon', $nm_icon);
            }
        });
    }
}
