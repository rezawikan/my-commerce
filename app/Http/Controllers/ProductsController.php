<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Storage;
use File;

class ProductsController extends Controller
{
    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $products = Product::where('name', 'like', '%'.$q.'%')->orderBy('updated_at', 'desc')->paginate(3);
        return view('admin.products.index')->with(compact(['products','q']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $options = Category::GroupArray();

        return view('admin.products.create')->with(compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|string|unique:products',
        'model' => 'required|string',
        'stock' => 'required|digits_between:1,3',
        'price' => 'required|numeric',
        'category' => 'required',
        'description' => 'required'
      ]);

        $data = $request->except(['category']);

        // if ($request->hasFile('photo')) {
        //     $data['photo'] = $request->file('photo')->store('products', 'public');
        // }

        $product = Product::create($data);
        $product->categories()->sync($request->category);
        // flash($request->get('name'). ' product saved')->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $options    = Category::GroupArray();
        $categories = $product->categories->pluck('id')->toArray();

        return view('admin.products.edit')->with(compact('product', 'options', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required|string',
        'model' => 'required|string',
        'stock' => 'required|digits_between:1,3',
        'price' => 'required|numeric',
        'category' => 'required|array|exists:categories,id',
        'description' => 'required',
      ]);

        $product = Product::findOrFail($id);
        $data    = $request->except(['category']);

        // if ($request->hasFile('photo')) {
        //     $data['photo'] = $request->file('photo')->store('products', 'public');
        //     if (isset($product->photo)) {
        //         File::delete(storage_path().'/app/public/'.$product->photo);
        //     }
        // }

        $product->update($data);
        if (count($request->category) > 0) {
            $product->categories()->sync($request->category);
        } else {
            $product->categories()->detech();
        }

        // flash($request->get('name').' product saved')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();

        if ($product->trashed()) {
            // if ($product->photo) {
            //     File::delete(storage_path().'/app/public/'.$product->photo);
            // }

            // flash('Product "'.$product->name.'" permanently deleted')->success();
            $product->forceDelete();
        } else {
            // flash('Product "'.$product->name.'" move to trash')->success();
            $product->delete();
        }
        return redirect()->route('products.index');
    }

    /**
     * Force remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashes(Request $request)
    {
        $q = $request->get('search');
        $products = Product::onlyTrashed()->where('name', 'LIKE', '%'.$q.'%')->paginate(10);
        return view('admin.products.trashes')->with(compact(['products','q']));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        $product->restore();
        flash('Product "'.$product->name.'" has restore')->success();
        return redirect()->route('products.trashes');
    }
}
