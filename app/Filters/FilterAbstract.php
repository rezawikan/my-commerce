<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterAbstract
{
    abstract public function filter(Builder $builder, $value);

    public function mappings()
    {
        return [];
    }

    protected function resolveFilterValue($value)
    {
        return array_get($this->mappings(), $value);
    }

    /**
     * Resolve the order direction to be used.
     *
     * @param  string $direction
     * @return string
     */
    protected function resolveOrder($order)
    {
        $value = implode(array_values($order)) ;

        return array_get([
          'desc' => 'desc',
          'asc' => 'asc'
      ], $value, 'desc');
    }

    /**
     * Resolve the order direction to be used.
     *
     * @param  string $direction
     * @return string
     */
    protected function resolveType($order)
    {
        return key($order);
    }

    /**
     * Resolve the order direction to be used.
     *
     * @param  string $direction
     * @return string
     */
    protected function resolveSlug($brands)
    {
      // dd($brands);
        return array_map(function ($brand) {
            return $brand['slug'];
        }, $brands);
    }
}
