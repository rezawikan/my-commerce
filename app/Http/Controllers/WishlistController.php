<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
* Instantiate a new controller instance.
*
* @return void
*/
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:customer');
    }

    /**
     * assign a wishlist to product.
     *
     * @param  object  $product
     * @return boolean
     */
    public function wishlistPost($id)
    {
        $product = Product::find($id);
        return auth()->user()->wishlists()->attach($product->id);
    }

    /**
     * unassign a wishlist to product.
     *
     * @param  object  $product
     * @return boolean
     */
    public function unWishlistPost($id)
    {
        $product = Product::find($id);
        return auth()->user()->wishlists()->detach($product->id);
    }

    /**
     * Display all wishlist products.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wishlistShow()
    {
        return auth()->user()->wishlists()->get();
    }
}
