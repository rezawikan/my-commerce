<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Product;

class ProductComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $product;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Product $product)
    {
        // Dependencies automatically resolved by service container...
        $this->product = $product;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('productComposer', $this->product);
    }
}
