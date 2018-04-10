<?php

namespace App\Filters;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Filters\FiltersAbstract;
use App\Filters\Product\SortFilters;
use Illuminate\Database\Eloquent\Builder;

abstract class FiltersAbstract
{

      /**
   * The filter factory instance.
   *
   * @var App\Filters
   */
    protected $request;

    protected $filters = [];

    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder, $value);
        }

        return $this->resolveCategory($builder);
    }

    protected function resolveCategory(Builder $builder)
    {
      $based      = class_basename(url()->current());
      $category   = Category::where('parent_id','!=', null)->pluck('slug');

      if ($category->contains($based)) {
          return $builder->whereHas('categories', function (Builder $builder) use ($based){
            $builder->where('slug',$based);
          });
      }

      return $builder;
    }

    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }

    protected function getFilters()
    {
        return $this->filterFilters($this->filters);
    }

    protected function filterFilters($filters)
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);
        return $this;
    }
}
