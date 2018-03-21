<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductImage extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
    protected $fillable = ['product_id','path','unique_id','basename','filename','size'];

    /**
     * Block comment
     *
     * @param type
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
