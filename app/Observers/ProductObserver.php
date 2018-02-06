<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Listen to the Product created event.
     *
     * @param  Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = str_slug($product->name);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  Product $product
     * @return void
     */
    public function deleting(Product $product)
    {
        if ($product->isForceDeleting()) {
            $product->categories()->detach();
        }
        $product->carts()->delete();
    }
}
