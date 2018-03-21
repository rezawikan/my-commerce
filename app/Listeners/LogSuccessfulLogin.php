<?php

namespace App\Listeners;

use App\Support\CartService;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
 * The cart factory instance.
 *
 * @var \App\Support\CartService
 */
    protected $cart;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // if (!auth()->guard('admin')) {
            // merge cart from cookie to db
            $cookie = $this->cart->merge();
        // }
    }
}
