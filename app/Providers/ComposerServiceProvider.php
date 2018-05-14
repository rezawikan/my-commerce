<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\ProductFiltersComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      // View::composer(
      //     '*', 'App\Http\ViewComposers\CategoryComposer'
      // );
      View::composer([
        'catalogs.partials._categories_list',
        'catalogs.partials._breadcrumb',
      ], ProductFiltersComposer::class);
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
