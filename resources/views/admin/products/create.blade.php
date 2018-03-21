@extends('admin.layouts.app')

@section('title', 'Create Products')

@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-md-12">
      <h3>New Product</a></small></h3>
      <form class="form-horizontal" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @include('admin.products._form')
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
        width: "100%"
      },
    }
    for (var selector in config) {
      $(selector).select2(config[selector]);
    }

    $('#summernote').summernote({
        height: 350,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote
      });

  });

  let files = [];

  // Dropzone.autoDiscover = false;
  // Dropzone class:
  let drop = new Dropzone("#file", {
    url: "{{ route('admin.upload.store', ['basename' => 'products']) }}",
    createImageThumbnails: true,
    addRemoveLinks: true,
    paramName: 'file',
    maxFilesize: 2,
    accept: function(file, done) {
      if (files.includes(file.name)) {
        file.previewElement.remove();
        console.log(file);
      } else {
        console.log(file);
        done();
      }
    },
    acceptedMimeTypes: 'image/*',
    headers: {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    },
    init: function() {
      current = this;

      axios.get('/master/upload/products')
        .then(function(response){
          // console.log(response.data);
            $.each(response.data, function (key, value) {
              console.log(value);
                var mockFile = { id: value.id, name: value.filename, size: value.size };
                current.emit("addedfile", mockFile);

                current.options.thumbnail.call(current, mockFile, window.location.origin + '/storage/' + value.path);
                // Make sure that there is no progress bar, etc...
                current.emit('complete', mockFile);
            });
        });
    }
  });


  // drop.emit()

  drop.on("complete", function(file) {
    // console.log(file);
    if (file.accepted === false) {
      file.previewElement.remove();
    }
  });

  drop.on('success', function(file, response) {
    console.log(response.id);
    file.id = response.id;
    files.push(file.name);
  });

  drop.on('removedfile', function(file, response){
    console.log(file.id);
    axios.delete('/master/upload/products/'+file.id)
    .then(response => console.log(response.data))
    .catch(response => console.log(response.data));
  });

</script>
@endpush
