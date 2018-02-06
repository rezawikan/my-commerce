@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')

  <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
              <h2>Products</h2>
              <ol class="breadcrumb">
                  <li>
                      <a href="index.html">Home</a>
                  </li>
                  <li>
                      <a>Products</a>
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
                      <div class="ibox-tools">
                          <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                          </a>
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                              <i class="fa fa-wrench"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                              <li><a href="#">Config option 1</a>
                              </li>
                              <li><a href="#">Config option 2</a>
                              </li>
                          </ul>
                          <a class="close-link">
                              <i class="fa fa-times"></i>
                          </a>
                      </div>
                  </div>
                  <div class="ibox-content">
                      <div class="row">
                          <div class="col-sm-5 m-b-xs"><select class="input-sm form-control input-s-sm inline">
                              <option value="0">Option 1</option>
                              <option value="1">Option 2</option>
                              <option value="2">Option 3</option>
                              <option value="3">Option 4</option>
                          </select>
                          </div>
                          <div class="col-sm-4 m-b-xs">
                              <div data-toggle="buttons" class="btn-group">
                                  <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                                  <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                                  <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                              </div>
                          </div>
                          <div class="col-sm-3">
                              <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                  <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                          </div>
                      </div>
                      <div class="table-responsive">
                          <table class="table table-striped">
                              <thead>
                              <tr>
                                <th>Name</th>
                                <th>Model</th>
                                <th>Photo</th>
                                <th>Desc</th>
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
                                      <td>{{ $product->description }}</td>
                                      <td>{{ $product->stock }}</td>
                                      <td>{{ $product->price }}</td>
                                      <td>{{ $product->updated_at }}</td>
                                      <td>
                                        <a href="{{ route('products.edit',['id' => $product->id ]) }}" class="btn btn-sm btn-primary" style="display: inline-block;">Edit</a>
                                        <form class="form-inline" action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
                                          {{ method_field('DELETE') }} {{ csrf_field() }}
                                          <button type="submit" class="btn btn-sm btn-primary">Move to Trash</button>
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
          </div>

      </div>
  </div>
@endsection
