<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer(
          '*', 'App\Http\ViewComposers\CategoryComposer'
      );
      View::composer(
          '*', 'App\Http\ViewComposers\ProductComposer'
      );
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
