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

    /**
     * Call some methods
     *
     * @param  array
     * @return array
     */
    public function filter(Builder $builder)
    {
        foreach ($this->filterFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder, $value);
        }

        return $builder;
    }

    /**
     * Parameter Filter
     *
     * @param  array  $this->filter
     * @return boolean
     */
    protected function filterFilters()
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    /**
     * Create new Object
     *
     * @param  string
     * @return object
     */
    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }

    /**
     * [Optional] add or assign some Filter
     *
     * @param  array
     * @return this
     */
    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);
        return $this;
    }

    /**
     * Get the Related sub-category Slug.
     *
     * @param  string  $value
     * @return array or null
     */
    // protected function related_slug($based)
    // {
    //     $category =  Category::where('slug', $based)->first();
    //     if (!empty($category)) {
    //         $result   = [$category->slug];
    //         foreach ($category->childs as $child) {
    //             // Array Merge and loop related slug in this function
    //             $result = array_merge($result, $this->related_slug($child->slug));
    //         }
    //         return $result;
    //     }
    //     return null;
    // }

    /**
     * Check existing categories
     *
     * @param  string  $value
     * @return boolean
     */
    // protected function checkCategory($value)
    // {
    //     $category = Category::pluck('slug')->toArray();
    //
    //     return in_array($value, $category);
    // }

    /**
     *  get result category
     *
     * @param  builder
     * @return boolean
     */
    // protected function resolveCategory(Builder $builder)
    // {
    //     $based      = class_basename(url()->current());
    //
    //     if ($based == 'catalogs') {
    //         return $builder;
    //     }
    //
    //     $related    = $this->related_slug($based) ?? [$based];
    //
    //     return $builder->whereHas('category', function (Builder $builder) use ($related) {
    //         $builder->whereIn('slug', $related);
    //     });
    // }

    // protected function getFilters()
    // {
    //     return $this->filterFilters();
    // }
}
