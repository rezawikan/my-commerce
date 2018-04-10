<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Filters\Product\ProductFilters;

class ProductFiltersComposer
{
    public function compose(View $view)
    {
        $view->with([
            'mappings' => ProductFilters::mappings()
        ]);
    }
}
