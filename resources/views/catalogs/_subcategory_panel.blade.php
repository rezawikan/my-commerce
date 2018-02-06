<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">Sub Category {{ $current->title }}</div>
  </div>
  <div class="list-group">
    @foreach ($current->childs as $child)
      <a href="{{url('/catalogs/'.$child->slug)}}" class="list-group-item">{{ $child->title }} <span class="badge">{{ $child->total_products }}</span></a>
    @endforeach
  </div>
</div>
