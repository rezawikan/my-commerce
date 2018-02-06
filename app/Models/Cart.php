<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
* The attributes that are mass assignable.
*
* @var array
*/
    protected $fillable = ['user_id','product_id','quantity'];

    /**
    * Block comment
    *
    * @param type
    * @return void
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
    * Block comment
    *
    * @param type
    * @return void
    */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
