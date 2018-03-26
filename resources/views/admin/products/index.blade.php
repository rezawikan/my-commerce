@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')

  <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
              <h2>Products</h2>
              <ol class="breadcrumb">
                  <li>
                      <a href="{{ route('admin.home') }}">Home</a>
                  </li>
                  <li>
                      <a href="{{ route('admin.products.index') }}">Products</a>
                  </li>
                  <li class="active">
                      <strong>List of Products</strong>
                  </li>
              </ol>
          </div>
          <div class="col-lg-2">

          </div>
      </div>
  <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>List of Products</h5>
                  </div>
                  <div class="ibox-content">
                    <div class="row">
                      <div class="col-sm-3 col-sm-offset-9">
                        <form class="form-inline" method="GET" action="{{ route('admin.products.trashes') }}">
                          <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control" placeholder="Type Product" name="q" value="{{ $q }}"> <span class="input-group-btn">
                              <button type="submit" class="btn btn-sm btn-primary"> Search</button> </span></div>
                            </form>
                      </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Model</th>
                              <th>Photo</th>
                              <th>Stock</th>
                              <th>Price</th>
                              <th>Last Update</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($products as $product)
                                <tr>
                                  <td>{{ $product->name }}</td>
                                  <td>{{ $product->model }}</td>
                                  <td>{{ $product->photo }}</td>
                                  <td>{{ $product->stock }}</td>
                                  <td>{{ $product->price }}</td>
                                  <td>{{ $product->updated_at }}</td>
                                  <td>
                                    <a href="{{ route('admin.products.edit',['id' => $product->id ]) }}" class="btn btn-sm btn-primary" style="display: inline-block;">Edit</a>
                                    <form class="form-inline" action="{{ route('admin.products.destroy', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
                                      {{ method_field('DELETE') }} {{ csrf_field() }}
                                      <button type="submit" class="btn btn-sm btn-primary">Move to Trash</button>
                                    </form>
                                  </td>
                                </tr>
                                @endforeach
                                <tr>
                                  <td colspan="7">{{ $products->appends('q')->links('vendor.pagination.default') }}</td>
                                </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
