<?php

namespace App\Http\Controllers;

use File;
use App\Models\Upload;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index($basename, $id = null)
    {
        if (isset($id)) {
            $products = Product::find($id);
            $products = $products->images;
        } else {
            $products = Upload::where('basename', $basename)->get();
        }


        return response()->json($products);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id        = Auth::guard('admin')->user()->id;
        // $name      = $request->file('file')->getClientOriginalName();
        $size      = $request->file('file')->getClientSize();
        $path      = Storage::putFile('temp/products', $request->file('file'));

        $data = ([
          'admin_id' => $id,
          'path' => 'temp/products/'.class_basename($path),
          'basename' => class_basename($request->path()),
          'filename' => class_basename($path),
          'size' => $size
        ]);


        $upload = Upload::create($data);

        return response()->json([
          'id' => $upload->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($basename, $id)
    {
        $upload = Upload::where('basename', $basename)->where('id', $id)->first();

        File::delete(storage_path().'/app/public/'.$upload->path);
        $upload->delete();
        return response()->json($upload);
    }
}
