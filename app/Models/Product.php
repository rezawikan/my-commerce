<?php

namespace App\Models;

use App\Models\Wishlist;
use App\Filters\Product\ProductFilters;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Middleware\Traits\TraitsRateable;

class Product extends Model
{
    use SoftDeletes;
    use TraitsRateable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name','slug','model','description','stock','price'];

    /**
      * Bootstrap any application services.
      *
      * @return void
      */
    public static function boot()
    {
        parent::boot();
        self::observe(ProductObserver::class);
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }


    /**
    * Determine whether a product has been marked as wishlist by a user.
    *
    * @return boolean
    */
    public function wishlisted()
    {
        return (bool) Wishlist::where('user_id', auth()->id())
                      ->where('product_id', $this->id)
                      ->first();
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    /**
     * Get random models
     */
    public function scopeRandom($query, $take = 3)
    {
        return $query->orderByRaw("RAND()")->take($take);
    }

    /**
     * This model has many ratings.
     *
     * @return Rating
     */
    public function ratings()
    {
        return $this->morphMany('App\Models\Rating', 'rateable');
    }

    /**
     * filter models
     */
    public function scopeFilter(Builder $builder, $request, array $filters = [])
    {
        return (new ProductFilters($request))->add($filters)->filter($builder);
    }

    /**
     * filter models
     */
    public function scopeCategory(Builder $builder, $value)
    {
        if ($value == null) {
            return $builder;
        }

        return $builder->whereHas('categories', function (Builder $builder) use ($value) {
            $builder->where('slug', $value);
        });
    }
    /**
     * filter models
     */
    public function scopeSlug(Builder $builder, $value)
    {
        if ($value == null) {
            return $builder;
        }

        return $builder->where('slug', $value);
    }
}
