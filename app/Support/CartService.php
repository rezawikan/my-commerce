<?php

namespace App\Support;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Cookie;

/**
*
*/
class CartService
{
    protected $request;

    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        if (Auth::check()) {
            return Cart::where('user_id', auth()->user()->id)->pluck('quantity', 'product_id');
        }

        $cookie = unserialize($this->request->cookie('cart'));
        if ($cookie) {
            return $cookie;
        }
        return $cookie = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalProduct()
    {
        if ($this->lists()) {
            return count($this->lists());
        } else {
            return 0;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function isEmpty()
    {
        return $this->totalProduct() < 1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notEmpty()
    {
        return $this->totalProduct() > 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find($id)
    {
        foreach ($this->details() as $order) {
            if ($order['id'] == $id) {
                return $order;
            }
        }
        return null;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $results = [];
        if ($this->notEmpty()) {
            foreach ($this->lists() as $id => $quantity) {
                $product = Product::findOrFail($id);
                array_push($results, [
                        'id' => $id,
                        'detail' => $product->toArray(),
                        'quantity' => $quantity,
                        'subTotal' => $product->last_price * $quantity
                    ]);
            }
        }

        return $results;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quantityCheck($product, $quantity)
    {
        if ($product->stock >= $quantity) {
            return true;
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalPrice()
    {
        $result = 0;
        foreach ($this->details() as $order) {
            $result += $order['subTotal'];
        }
        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function merge()
    {
        $cookie = unserialize($this->request->cookie('cart')); // null is false
        if ($cookie) {
          // return auth()->user()->id;
            foreach ($cookie as $product_id => $quantity) {
                $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product_id)->first();
                if (!$cart) {
                    Cart::create([
                      'user_id' => auth()->user()->id,
                      'product_id' => $product_id,
                      'quantity' => $quantity
                    ]);
                } else {
                    $cart->quantity += $quantity;
                    $cart->save();
                }

                setcookie('cart','');
            }
        }
    }
}
