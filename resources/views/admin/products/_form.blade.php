{{ csrf_field() }}
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  <label class="col-lg-2 control-label">Name</label>
  <div class="col-lg-10">
    <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $product->name ?? old('name') }}">
    @if ($errors->has('name'))
      <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
    @endif
  </div>
</div>
<div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
  <label class="col-lg-2 control-label">Model</label>
  <div class="col-lg-10">
    <input type="text" name="model" placeholder="Model" class="form-control" value="{{ $product->model ?? old('model') }}">
    @if ($errors->has('model'))
      <span class="help-block m-b-none">{{ $errors->first('model') }}</span>
    @endif
  </div>
</div>
<div class="form-group {{ $errors->has('stock') ? 'has-error' : '' }}">
  <label class="col-lg-2 control-label">Stock</label>
  <div class="col-lg-10">
    <input type="text" name="stock" placeholder="Stok" class="form-control" value="{{ $product->stock ?? old('stock') }}">
    @if ($errors->has('stock'))
      <span class="help-block m-b-none">{{ $errors->first('stock') }}</span>
    @endif
  </div>
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
  <label class="col-lg-2 control-label">Price</label>
  <div class="col-lg-10">
    <input type="text" name="price" placeholder="Price" class="form-control" value="{{ $product->price ?? old('price') }}">
    @if ($errors->has('price'))
      <span class="help-block m-b-none">{{ $errors->first('price') }}</span>
    @endif
  </div>
</div>
<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }} ">
  <label class="col-lg-2 control-label">Category</label>
  <div class="col-lg-10">
    <select data-placeholder="Choose Category" class="form-control chosen-select" multiple name="category[]">
      <option value="">Select</option>
      @foreach ($options as $slug => $option)
        <optgroup label="{{ $slug }}">
          @foreach ($option as $value)
            @if (isset($categories) && in_array($value->id, $categories))
              <option value="{{ $value->id }}" selected>{{ $value->title }}</option>
            @else
              <option value="{{ $value->id }}">{{ $value->title }}</option>
            @endif
          @endforeach
        </optgroup>
      @endforeach
    </select>
    @if ($errors->has('category'))
      <span class="help-block m-b-none">{{ $errors->first('category') }}</span>
    @endif
  </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
  <label class="col-lg-2 control-label">Description</label>
  <div class="col-lg-10">
    <textarea id="summernote" name="description" class="form-control" placeholder="Description" >{{ $product->description ?? old('description') }}</textarea>
    @if ($errors->has('description'))
      <span class="help-block m-b-none">{{ $errors->first('description') }}</span>
    @endif
  </div>
</div>
<div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
  <label class="col-lg-2 control-label">Photo</label>
  <div class="col-lg-10">
    <div id="file" class="dropzone"></div>
    <span class="help-block m-b-none">The first image will be the main image</span>
    {{-- <input type="file" name="photo" >
    @if ($errors->has('photo'))
      <span class="help-block m-b-none">{{ $errors->first('photo') }}</span>
    @endif --}}
  </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button class="btn btn-md btn-primary" type="submit">Save</button>
    </div>
</div>
