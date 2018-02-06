@extends('layouts.app')

@section('title', 'Create Categories')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>New Category</a></small></h3>
      @include('flash::message')
      <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}">
          @include('categories._form')
      </form>
    </div>
  </div>
</div>
@endsection
