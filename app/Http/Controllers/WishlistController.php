<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\User;
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
        return $product->wishlist()->attach(auth()->id());
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
        return $product->wishlist()->detach(auth()->id());
    }

    /**
     * unassign a wishlist to product.
     *
     * @param  object  $product
     * @return boolean
     */
    public function checkWishlist($id)
    {
        $user = User::find($id);
        return $user->wishlists->pluck('product_id');
    }
}
