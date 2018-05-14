<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\CartService;

class ApiCartServiceController extends Controller
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
    }

    /**
     * Display a listing of the carts.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartDetails()
    {
      return $this->cart->details() ?? null;
    }
}
