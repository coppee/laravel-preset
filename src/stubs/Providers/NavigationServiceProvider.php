<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['open._layouts.app'], function ($view)
        {
            $mainNavigation = trans('layout.main-navigation');

            $socialMediaNavigation = [
                'facebook-f' => "https://www.facebook.com",
                'twitter' => "https://twitter.com",
                'youtube' => "https://www.youtube.com",
            ];

            $view->with(compact('mainNavigation','socialMediaNavigation'));
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
