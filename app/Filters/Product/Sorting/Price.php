<?php

namespace App\Filters\Product\Sorting;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Price extends FilterAbstract
{

    /**
     * Order by views in descending
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $direction)
    {
        $contain = strpos($direction, 'and');
        if ($contain) {
            $array   = explode('and', $direction);
            // dd($array);
            if (in_array(null, $array)) {
                return $builder;
            }

            foreach ($array as $key => $value) {
                if (!is_numeric($value)) {
                    return $builder;
                }
            }

            if ($array[1] < $array[0]) {
                return $builder;
            }

            if (!request()->has('sort')) {
                $builder->whereBetween('price', $array)->orderBy('created_at', 'desc');
            }

            return $builder->whereBetween('price', $array);
        }
    }
}
