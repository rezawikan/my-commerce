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
                $map[$value->slug]['total'] = $value->total;
                foreach ($value->childs as $sub) {
                    $map[$value->slug]['value'][$sub->slug]['total'] = $sub->total;
                    if ($sub->hasChild()) {
                        $map[$value->slug]['value'][$sub->slug]['childs'] = ProductFilters::related($sub);
                    }
                }
            }
            return $map;
        });
    }

    public static function related(Category $based)
    {
        $result   = [];
        foreach ($based->childs as $child) {
            // Array Merge and loop related slug in this function
            $result = array_merge($result, [$child->slug]);
            if ($child->hasChild()) {
                $result = array_merge($result, ProductFilters::related($child));
            }
        }
        return $result;
    }
}
