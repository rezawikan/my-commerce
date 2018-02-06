@extends('layouts.app')

@section('title', 'Edit Products | '. $product->title)

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>New Product</a></small></h3>
      <form class="form-horizontal" method="POST" action="{{ route('products.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @include('products._form')
      </form>
    </div>
  </div>
</div>
@endsection 

@push('last-scripts')
<script type="text/javascript">
  $(document).ready(function() {

    var config = {
      '.chosen-select': {
        theme: "bootstrap",
        maximumSelectionSize: 6
      },
    }
    for (var selector in config) {
      $(selector).select2(config[selector]);
    }

  });
</script>
@endpush
