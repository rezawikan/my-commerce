<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;

class CatalogsController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Request $request - Request from search form
     * @param string $category - from URI category
     * @param  string $slug - from URI product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category = null)
    {

      // $product = Product::find(2);
      // // return $product;
      //
      // $rating = new Rating;
      // $rating->rating = 4;
      // $rating->comment = 'wowsasd';
      // $rating->user_id = 2;
      //
      // $product->ratings()->save($rating);
      //
      // return 'wos';
      // return Product::first()->ratings;

        // return $category
        $min = $max = 0;
        $search = $request->get('search');
        if (isset($category)) {
            $selectedCategory = Category::where('slug', $category)->first();
            $products  = Product::whereIn('slug', $selectedCategory->related_slug)->where('name', 'LIKE', '%'.$search.'%');

            // return $selectedCategory;
          // if (isset($slug)) {
              // $products  = Product::whereIn('slug', $selectedCategory->related_slug)->where('slug', $category);
              // return var_dump($products) ;
          // } else {
              // $products  = Product::whereIn('slug', $selectedCategory->related_slug)->where('name', 'LIKE', '%'.$search.'%');
          // }
        } else {
            $products = Product::where('name', 'LIKE', '%'.$search.'%');
        }

        // return $products->get();

        $min  = $request->get('min');
        $max = $request->get('max');
        if ($request->has('min')) {
            $products = $products->whereBetween('price', [$min,$max]);
        } else {
            $min = $products->min('price');
            $max = $products->max('price');
        }

        $sort  = $request->get('sort');
        $order = $request->get('order');
        if ($request->has('sort')) {
            $order = in_array($order, ['asc','desc']) ? $order : 'asc';
            $field = in_array($sort, ['price','name']) ? $sort : 'price';
            $products = $products->orderBy($field, $order);
        }

        $products = $products->paginate(12);
        // return $products->where('');

        return view('catalogs.index')->with(compact('products', 'category', 'selectedCategory', 'search', 'sort', 'order', 'min', 'max'));
    }

    public function show($category, $slug)
    {
        $selectedCategory = Category::where('slug', $category)->first();
        $product  = Product::whereIn('slug', $selectedCategory->related_slug)->where('slug', $slug)->first();
        $related = Product::whereIn('slug', $selectedCategory->related_slug)->whereNotIn('slug', [$product->slug]);
        $relatedProducts = $related->random(10)->get();
        // return $product->images;
        return view('catalogs.show')->with(compact('product', 'relatedProducts'));
    }
}
