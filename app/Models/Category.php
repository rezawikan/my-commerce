<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['title','parent_id'];


    /**
      * Bootstrap any application services.
      *
      * @return void
      */
    public static function boot()
    {
        parent::boot();
        self::observe(CategoryObserver::class);
    }

    /**
     * Get the Related Slug.
     *
     * @param  string  $value
     * @return string
     */
    public function getRelatedSlugAttribute()
    {
        $result = $this->products->pluck('slug')->toArray();

        foreach ($this->childs as $child) {
            // Array Merge and loop related slug in this function
            $result = array_merge($result, $child->related_slug);
        }

        return $result;
    }

    /**
    * Get total Products.
    *
    * @param  string  $value
    * @return string
    */
    public function getTotalProductsAttribute()
    {
        return Product::whereIn('slug', $this->related_slug)->count();
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGroupArray($query)
    {
        $options = $this->all();
        $parent  = $this->NoParent()->pluck('title', 'id');
        $result  = array();

        foreach ($parent as $key => $value) {
            foreach ($options as $option) {
                if ($option->parent_id == $key) {
                    $result[$value][] = $option;
                }
            }
        }
        return $result;
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNoParent($query)
    {
        return $this->where('parent_id', null);
    }



    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function hasParent()
    {
        return $this->parent_id > 0;
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function hasChild()
    {
        return $this->childs->count() > 0;
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
}
