<?php

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //using the class based composer
        View::composer(
            'master.header', 'App\Http\ViewComposers\NotificationComposer'


        );
        View::composer(
            'master.app', 'App\Http\ViewComposers\UIComposer'


        );
        View::composer(
            'master.head', 'App\Http\ViewComposers\UIComposer'


        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
