<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Models\Upload;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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
    * Listen to the User created event.
    *
    * @param  \App\User  $user
    * @return void
    */
    public function created(Product $product)
    {
        if (auth('admin')->check()) {
            $admin_id = auth()->guard('admin')->user()->id;
            $uploads  = Upload::where('admin_id', $admin_id)->where('basename', 'products')->get();
            $uniqueid = uniqid();

            if (!empty($uploads)) {
                foreach ($uploads as $key => $value) {
                    $path = Storage::disk('public')->move($value->path, 'products/'.$uniqueid.'/'.$value->filename);
                    ProductImage::create([
                'product_id' => $product->id,
                'path' => 'products/'.$uniqueid.'/'.$value->filename,
                'unique_id' => $uniqueid,
                'basename' => $value->basename,
                'filename' => $value->filename,
                'size' => $value->size
              ]);

                    Upload::find($value->id)->delete();
                }
            }
        }
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
