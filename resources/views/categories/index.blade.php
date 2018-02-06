@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>Category<small class="m-l-sm"><a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">New Category</a></small></h3>
      @include('flash::message')
      <form class="form-inline" method="GET" action="{{ route('categories.index') }}">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Type Category" name="q" value="{{ $q }}">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
      <table class="table table-hover">
        <thead>
          <tr>
            <td>Title</td>
            <td>Parent</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category->title }}</td>
            <td>{{ $category->parent ? $category->parent->title : '' }}</td>
            <td>
              <a href="{{ route('categories.edit',['id' => $category->id]) }}" class="btn btn-sm btn-primary" style="display: inline-block;">Edit</a>
              <form class="form-inline" action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="POST" style="display: inline-block;">
                {{ method_field('DELETE') }} {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-primary">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3">{{ $categories->appends('q')->links() }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
