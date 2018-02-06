<ol class="breadcrumb">
  @if (!isset($selectedCategory))
    <li>Semua Produk</li>
  @else
    <li><a href="{{route('catalogs.index')}}">Produk</a></li>
    @if (isset($selectedCategory) && $selectedCategory->parent)
      <li><a href="{{ url('/catalogs/'.$selectedCategory->parent->slug) }}">{{ $selectedCategory->parent->title }}</a></li>
    @endif
    <li>{{ $selectedCategory->title }}</li>
  @endif

  <span class="pull-right">
    <a href="{{ appendQueryString(['sort' => 'price', 'order' => 'asc']) }}" class="btn btn-default btn-xs {{isQueryString(['sort' => 'price', 'order' => 'asc']) ? 'active' : ''}}">Termurah</a>
    <a href="{{ appendQueryString(['sort' => 'price', 'order' => 'desc']) }}" class="btn btn-default btn-xs {{isQueryString(['sort' => 'price', 'order' => 'desc']) ? 'active' : ''}}">Termahal</a>
  </span>
</ol>



<select class="form-control" id="sorting" onchange="location=this.option">
  <option data-option={{ appendQueryString(['sort' => 'price', 'order' => 'asc']) }} {{isQueryString(['sort' => 'price', 'order' => 'asc']) ? 'selected' : ''}}>Popularity</option>
  <option>Low - High Price</option>
  <option>High - Low Price</option>
  <option>Avarage Rating</option>
  <option>A - Z Order</option>
  <option>Z - A Order</option>
</select><span class="text-muted">Showing:&nbsp;</span><span>{{ $products->firstItem() }} - {{ $products->