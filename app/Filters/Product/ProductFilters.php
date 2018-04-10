<?php

namespace App\Filters\Product;

use Illuminate\Support\Facades\Cache;
use App\Filters\FiltersAbstract;
use App\Filters\Product\Sorting\Sort;
use App\Filters\Product\Sorting\Price;
use App\Models\Category;

class ProductFilters extends FiltersAbstract
{
    //
    protected $filters = [
      'sort' => Sort::class,
      'price'  => Price::class
    ];

    public static function mappings()
    {
        return Cache::remember('categories', 100, function () {
            $category = Category::noParent()->get();
            $map      = [];
            foreach ($category as $key => $value) {
                foreach ($value->childs as $sub) {
                    $map[$value->slug][$sub->slug] = $sub->total;
                }
            }
            return $map;
        });
    }
}
