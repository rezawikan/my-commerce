<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ProductsController extends Controller
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
        $catalogs = Product::with(['categories'])->category($category)->filter($request)->get();

        return response()->json($catalogs, 200);
    }

    public function show(Request $request, $category = null, $slug = null)
    {
        $catalogs = Product::with(['categories'])->category($category)->slug($slug)->filter($request)->get();

        return response()->json($catalogs, 200);
    }
}
