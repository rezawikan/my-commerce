<?php

namespace App\Models;

use App\Models\Wishlist;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Rating;
use App\Models\ProductImage;
use App\Filters\Product\ProductFilters;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Middleware\Traits\TraitsRateable;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use SoftDeletes;
    use TraitsRateable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name','slug','description','stock','discount','price','category_id','discount'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['featured_image','last_price'];

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
 * Get the user's full name.
 *
 * @return string
 */
    public function getFeaturedImageAttribute()
    {
        return "https://dummyimage.com/600x400/ffffff/000000";
    }

    /**
 * Get the user's full name.
 *
 * @return string
 */
    public function getLastPriceAttribute()
    {
        $discount = $this->discount;
        $price    = $this->price;
        if ($discount) {
            $cut      = $price * ($discount/100);
            return round($price - $cut);
        }
        return $price;
    }


    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    /**
    * Determine whether a product has been marked as wishlist by a user.
    *
    * @return boolean
    */
    public function wishlist()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id')->withTimeStamps();
    }

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
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
        return $this->morphMany(Rating::class, 'rateable');
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
    public function scopeSlugs(Builder $builder, $category = null, $slug = null)
    {
        $related  = $this->related_slug($category) ?? [$category];

        return $builder->when($slug, function ($query) use ($slug) {
            return $query->where('name', $slug);
        })->when($related, function ($query) use ($related) {
            return $query->whereHas('category', function (Builder $builder) use ($related) {
                return $builder->whereIn('slug', $related);
            });
        });

        return $builder;
    }

    /**
     * Get the Related sub-category Slug.
     *
     * @param  string  $value
     * @return array or null
     */
    protected function related_slug($based)
    {
        $category =  Category::where('slug', $based)->first();
        if (!empty($category)) {
            $result   = [$category->slug];
            foreach ($category->childs as $child) {
                // Array Merge and loop related slug in this function
                $result = array_merge($result, $this->related_slug($child->slug));
            }
            return $result;
        }
        return null;
    }
}
