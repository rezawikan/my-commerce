@extends('layouts.app')

@section('title', 'Products Trashes')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Product Trashes<small class="m-l-sm"><a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Back</a></small></h3>
        @include('flash::message')
        <form class="form-inline" method="GET" action="{{ route('products.trashes') }}">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Type Product" name="q" value="{{ $q }}">
          </div>
          <button type="submit" class="btn btn-default">Search</button>
        </form>
        <table class="table table-hover">
          <thead>
            <tr>
              <td>Name</td>
              <td>Model</td>
              <td>Photo</td>
              <td>Desc</td>
              <td>Stock</td>
              <td>Price</td>
              <td>Last Update</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td>{{ $product->model }}</td>
              <td>{{ $product->photo }}</td>
              <td>{{ $product->description }}</td>
              <td>{{ $product->stock }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->updated_at }}</td>
              <td>
                <form class="form-inline" action="{{ route('products.restore', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                </form>
                <form class="form-inline" action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
                  {{ method_field('DELETE') }} {{ csrf_field() }}
                  <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="8">{{ $products->appends('q')->links() }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
