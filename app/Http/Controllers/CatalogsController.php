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
//       $product = Product::find(1);
//         // return $product;
//
//         $rating = new Rating;
//         $rating->subject = 'Test for comment 1';
//         $rating->rating = 4;
//         $rating->review = 'wowsasd';
//         $rating->user_id = 2;
//
//         $product->ratings()->save($rating);
//
//         $product = Product::find(1);
//         $rating = new Rating;
//         $rating->subject = 'Test for comment 2';
//         $rating->rating = 3;
//         $rating->review = 'wasday768asd87owsasd';
//         $rating->user_id = 1;
//
//         $product->ratings()->save($rating);
//
// $product = Product::find(1);
//         $rating = new Rating;
//         $rating->subject = 'Test for comment 3';
//         $rating->rating = 5;
//         $rating->review = 'wasday768asd87erytuowsasd';
//         $rating->user_id = 3;
//
//         $product->ratings()->save($rating);
//
//             $a = Rating::find(1);
//             return $a->user_name;
//
//         return 'test';


        // return $category
        $min = $max = 0;
        $search = $request->get('search');
        if (isset($category)) {
            $selectedCategory = Category::where('slug', $category)->first();
            $products  = Product::whereIn('slug', $selectedCategory->related_slug)->where('name', 'LIKE', '%'.$search.'%');
        } else {
            $products = Product::where('name', 'LIKE', '%'.$search.'%');
        }

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

        $products = $products->paginate(6);

        // return $products;

        return view('catalogs.index')->with(compact('products', 'category', 'selectedCategory', 'search', 'sort', 'order', 'min', 'max'));
    }

    public function show($category, $slug)
    {
        $product = Product::with(['categories' => function ($query) use ($category) {
            $query->where('slug', $category);
        }])->where('slug', $slug)->first();

        $relatedProducts = Product::with(['categories' => function ($query) use ($category, $product) {
            $query->where('slug', $category)->whereNotIn('slug', [$product->slug]);
        }])->random(10)->get();

        return view('catalogs.show')->with(compact('product', 'relatedProducts'));
    }
}
