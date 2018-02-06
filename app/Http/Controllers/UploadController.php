<?php

namespace App\Http\Controllers;

use File;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id        = Auth::guard('admin')->user()->id;
        $name      = $request->file('file')->getClientOriginalName();
        $path      = $request->file('file')->storeAs('temp/products',$name);

        $data = ([
          'admin_id' => $id,
          'path' => $path,
          'basename' => class_basename($request->path())
        ]);

        $upload = Upload::create($data);

        return response()->json([
          'id' => $upload->id,
          'path' => $path,
          'extension' => class_basename($request->path())
      ]);
    }
}
