<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:superadmin,admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $categories = Category::where('title', 'like', '%'.$q.'%')->orderBy('updated_at', 'desc')->paginate(5);
        return view('categories.index')->with(compact(['categories','q']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = Category::where('parent_id', null)->pluck('title', 'id');
        return view('categories.create')->with(compact('options'));
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
        'title'   => 'required|string|alpha|max:255|unique:categories',
        'parent_id'  => 'nullable|exists:categories,id'
      ]);

        Category::create($request->all());
        flash($request->get('title'). ' category saved')->success();
        return redirect()->route('categories.index');
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
        $options  = Category::where('parent_id', null)->pluck('title', 'id');
        $category = Category::findOrFail($id);
        return view('categories.edit')->with(compact(['category','options']));
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
        $category = Category::findOrFail($id);
        $this->validate($request, [
        'title'   => 'required|string|alpha|max:255|unique:categories,title,'. $category->id,
        'parent_id'  => 'nullable|exists:categories,id'
      ]);
        $category->update($request->all());
        flash($request->get('title'). ' category updated')->success();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        flash('Category "'.$category->title.'" deleted')->success();
        return redirect()->route('categories.index');
    }
}
