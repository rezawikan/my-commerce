<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Wishlist extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
    protected $fillable = ['user_id','product_id'];

}
