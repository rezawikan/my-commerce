<?php

namespace App\Filters\Product\Sorting;

use App\Models\Brand;
use App\Filters\FilterAbstract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class Brands extends FilterAbstract
{
    public function mappings()
    {
        return Cache::remember('brands', 100, function () {
            return $brands = Brand::get()->toArray();
        });
    }
    /**
     * Order by views in descending
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $value)
    {
        $array = explode('--', $value);
        if ($array == null) {
            return $builder;
        }

        $slug = $this->resolveSlug($this->mappings());
        $checked = !array_diff($array, $slug);

        if ($checked) {
            return $builder->whereHas('brand', function (Builder $builder) use ($array) {
                $builder->whereIn('slug', $array);
            });
        } else {
            return $builder;
        }
    }
}
