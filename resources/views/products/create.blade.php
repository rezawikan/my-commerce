@extends('admin.layouts.app')

@section('title', 'Create Products')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>New Product</a></small></h3>
      <form class="form-horizontal" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @include('products._form')
      </form>
    </div>
  </div>
</div>
@endsection

@push('b-scripts')
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

  let files = [];

  Dropzone.autoDiscover = false;
  // Dropzone class:
  let drop = new Dropzone("#file", {
    url: "{{ route('upload.products.store') }}",
    createImageThumbnails: true,
    addRemoveLinks: true,
    paramName: 'file',
    maxFilesize: 2,
    accept: function(file, done) {
      if (files.includes(file.name)) {
        file.previewElement.remove();
      } else {
        done();
      }
    },
    acceptedMimeTypes: 'image/*',
    headers: {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    }
  });

  drop.on("complete", function(file) {
    console.log(file);
    if (file.accepted === false) {
      file.previewElement.remove();
      $('#file').removeClass('dz-started');
      alert("Tidak di perbolehkan");
    }
  });

  drop.on('success', function(file, response) {
    file.id = response.id;
    files.push(file.name);
    console.log(files);
  });

</script>
@endpush
