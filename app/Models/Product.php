<?php

namespace App\Models;

use App\Models\Wishlist;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name','slug','photo','model','description','stock','price'];

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
}
