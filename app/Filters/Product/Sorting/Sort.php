<?php

namespace App\Filters\Product\Sorting;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Sort extends FilterAbstract
{
    public function mappings()
    {
        return [
            'pricedesc' => [
              'price' => 'desc'
            ],
            'priceasc' => [
              'price' => 'asc'
            ],
            'namedesc' => [
              'name' => 'desc'
            ],
            'nameasc' => [
              'name' => 'asc'
            ]
        ];
    }
    /**
     * Order by views in descending
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $direction)
    {
        $value = $this->resolveFilterValue($direction);

        if ($value == null) {
            return $builder->orderBy('created_at', 'desc');
        }

        return $builder->orderBy($this->resolveType($value), $this->resolveOrder($value));
    }
}
