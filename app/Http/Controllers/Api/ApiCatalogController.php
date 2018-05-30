<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\CatalogResource;
use App\Filters\Product\ProductFilters;
use App\Filters\Product\Sorting\Sort;
use App\Filters\Product\Sorting\Brands;

// use App\Filters\Product\ProductFilters;

class ApiCatalogController extends Controller
{
    public function maps()
    {
        return ProductFilters::mappings();
    }
    /**
     * Display a listing of the resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function index(Request $request, $category)
    {
        return new CatalogResource(
        Product::with(['category'])->filter($request)->slugs($category)->paginate(9)->appends(request()->except('page'))
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

    /**
     * Display a resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function sort()
    {
        $sort = new Sort();
        return response()->json([
          'data' => $sort->mappings()
        ], 200);
    }

    /**
     * Display a resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function brands()
    {
        $brands = new Brands();
        return response()->json([
          'data' => $brands->mappings()
        ], 200);
    }

    /**
     * Display a resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function minmax(Request $request, $category)
    {
        return response()->json([
        'min' => Product::with(['category'])->filter($request)->slugs($category)->min('price'),
        'max' => Product::with(['category'])->filter($request)->slugs($category)->max('price')
      ], 200);
    }

    /**
     * Display a resource.
     * @param Request $request - Request from some params
     * @param string $category - from URI category
     * @return object CatalogResource
     */
    public function layout(Request $request, $type = null)
    {
        $cookie = unserialize($request->cookie('layout'));
        if ($cookie && $type == null) {
            return $cookie;
        } elseif ($type) {
            return response($type)->cookie('layout', serialize($type), 360*1000);
        }

        return response('grid')->cookie('layout', serialize('grid'), 360*1000);
    }
}
