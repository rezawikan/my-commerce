<?php

namespace App\Filters\Product;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Example extends FilterAbstract
{
    public function mappings()
    {
        return [
      'free'    => true,
      'premium' => false,
    ];
    }
    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValue($value);

        if ($value == null) {
            return $Builder;
        }

        return $builder;

        // return $builder->where('price', '>', $value);

        // return $builder->whereHas('subjects', function (Builder $builder) use ($value){
        //   $builder->where('slug', $value);
        // });
    }
}
