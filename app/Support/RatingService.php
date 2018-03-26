<?php

namespace App\Support;

use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Product;

/**
*
*/
class RatingService
{
    // protected $request;

    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    // public function __construct(Request $request)
    // {
    //     $this->request = $request;
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
      $product = Product::find($id);
      $ratings = $product->ratings()->orderBy('created_at','DESC')->paginate(4);

      return $ratings;
    }
}
