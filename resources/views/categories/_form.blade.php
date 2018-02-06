{{ csrf_field() }}
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-lg-2 control-label">Title</label>
  <div class="col-lg-10">
    <input type="text" name="title" placeholder="Title" class="form-control" value="{{ isset($category->title) ? $category->title : old('title') }}">
    @if ($errors->has('title'))
      <span class="help-block m-b-none">{{ $errors->first('title') }}</span>
    @endif
  </div>
</div>
<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }} ">
  <label class="col-lg-2 control-label">Parent (Optional)</label>
    <div class="col-lg-10">
      <select class='form-control' name="parent_id" value="{{ old('parent_id') }}">
        <option value="">Select</option>
        @foreach ($options as $key => $option)
          @if (isset($category->parent->id) ?  $category->parent->id == $key : false)
            <option value="{{ $key }}" selected>{{ $option}}</option>
          @else
            <option value="{{ $key }}">{{ $option}}</option>
          @endif
        @endforeach
      </select>
      @if ($errors->has('parent_id'))
        <span class="help-block m-b-none">{{ $errors->first('parent_id') }}</span>
      @endif
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button class="btn btn-md btn-primary" type="submit">Save</button>
    </div>
</div>
