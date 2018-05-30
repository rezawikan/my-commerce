<?php

namespace App\Filters\Product\Sorting;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class Sort extends FilterAbstract
{
    public function mappings()
    {
        return [
          'new' => [
            'name' => 'Terbaru',
            'filter' => [
              'created_at' => 'desc'
            ]
          ],
            'pricedesc' => [
              'name' => 'Termahal',
              'filter' => [
                'price' => 'desc'
              ]
            ],
            'priceasc' => [
              'name' => 'Terendah',
              'filter' => [
              'price' => 'asc'
              ]
            ],
            'nameasc' => [
              'name' => 'A - Z Order',
              'filter' => [
              'name' => 'asc'
              ]
            ],
            'namedesc' => [
              'name' => 'Z - A Order',
              'filter' => [
              'name' => 'desc'
              ]
            ],
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

        return $builder->orderBy($this->resolveType($value['filter']), $this->resolveOrder($value['filter']));
    }
}
