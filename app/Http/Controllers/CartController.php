<?php

namespace App\Http\Controllers;

use Cookie;
use App\Models\Cart;
use App\Models\Product;
use App\Support\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
 * The cart factory instance.
 *
 * @var \App\Support\CartService
 */
    protected $cart;

    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
        $this->middleware('guest');
    }


    /**
     * Display a listing of the carts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Handle add product to carts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
      'product_id' => 'required|exists:products,id',
      'quantity' => 'required|integer|min:1'
    ]);

        $product    = Product::findOrFail($request->product_id);
        $quantity   = $request->quantity;

        if (Auth::check()) {
            $cart = Cart::firstOrNew([
          'product_id' => $request->product_id,
          'user_id' => $request->user()->id,
        ]);

            $cart->quantity += $quantity;
            $cart->save();

            return redirect()->back()->with('added', $product->name);
        } else {
            $cart       = $this->cart->lists(); // get cookie. if default, cookie is set to null

            if (is_string($cart)) { // check cookie is string, cookie only save data string
            $cart = unserialize($cart); // convert to array
            }

            if ($product->stock > 0) {
                if (array_key_exists($product->id, $cart)) {
                    $quantity += $cart[$product->id];
                }

                $cart[$product->id] = $quantity;
            } else {
                // flash($product->name. ' stock out')->error();
                return  redirect()->back();
            }
            // Cookie::queue('cart', serialize($cart), 360*1000);
            return response($cart)->cookie('cart', serialize($cart), 360*1000);
            // return redirect()->back()->withCookie(cookie()->forever('cart', serialize($cart)))->with('added', $product->name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product  = Product::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
    'quantity' => 'required|integer|min:1'
  ]);

        if (Auth::check()) {
            $cart = Cart::updateOrCreate([
          'product_id' => $id,
          'user_id' => $request->user()->id,
        ]);

            $cart->quantity = $request->quantity;
            $cart->save();

            $request->session()->flash('message', 'Task was successful!');

            return redirect('cart');
        } else {
            $quantity = $request->quantity;
            $cart     = $this->cart->find($id);
            if (!$cart) {
                return redirect('cart');
            }

            $request->session()->flash('message', 'Task was successful!');

            $cart      = $this->cart->lists();
            $cart[$id] = $quantity;
            return redirect('cart')->withCookie(cookie()->forever('cart', serialize($cart)));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            $cart = Cart::firstOrNew([
          'product_id' => $id,
          'user_id' => $request->user()->id
        ]);

            $cart->delete();
            // $request->session()->flash('message', 'Task was successful!');
            // return redirect('cart');
        } else {
            $cart = $this->cart->find($id);

            if (!$cart) {
                // return redirect('cart');
            }

            $cart = $this->cart->lists();
            unset($cart[$id]);

            Cookie::queue('cart', serialize($cart), 1200);
            return json_encode(serialize($cart));
        }
    }
}
