@extends('layouts.app')

@section('title', 'Edit Categories '. $category->title)

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Edit Category {{ $category->title }} </a></small></h3>
        <form class="form-horizontal" method="POST" action="{{ route('categories.update', ['id' => $category->id]) }}">
            {{ method_field('PUT') }}
            @include('categories._form')
        </form>
      </div>
    </div>
  </div>
@endsection
