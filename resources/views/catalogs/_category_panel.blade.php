<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">Category</div>
  </div>
  <div class="list-group">
    <a href="{{ route('catalogs.index') }}" class="list-group-item">Semua Produk <span class="badge">{{ App\Models\Product::count() }}</span></a>
    @foreach (App\Models\Category::noParent()->get() as $category)
      <a href="{{ url('/catalogs/'.$category->slug) }}" class="list-group-item">{{ $category->title }}<span class="badge">{{ $category->total_products }}</span></a>
    @endforeach
  </div>
</div>
