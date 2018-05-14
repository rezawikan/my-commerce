<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\CatalogResource;
use App\Filters\Product\ProductFilters;

class ApiCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function index(Request $request, $category)
    {
        return new CatalogResource(
        Product::with(['category'])->filter($request)->slugs($category)->paginate(9)
      );
    }

    /**
     * Display a resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function show($category, $slug = null)
    {
        return response()->json([
          'data' => Product::with(['category'])->slugs($category, $slug)->first()
      ], 200);
    }


    /**
     * Display a resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function categories()
    {
        return response()->json([
          'data' => ProductFilters::mappings()
        ], 200);
    }

    public function max(Request $request, $category)
    {
        return response()->json([
        'data' => Product::with(['category'])->filter($request)->slugs($category)->max('price')
      ], 200);
    }

    public function min(Request $request, $category)
    {
        return response()->json([
        'data' => Product::with(['category'])->filter($request)->slugs($category)->min('price')
      ], 200);
    }
}
