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
        $products = Product::with(['categories'])->filter($request)->paginate(2);

        // return $products;
        return view('catalogs.index')->with(compact('products'));
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
