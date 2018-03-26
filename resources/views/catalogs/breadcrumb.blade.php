<div class="page-title">
  <div class="container">
    @if (!isset($selectedCategory))
      <div class="column">
        <h1>All Products</h1>
      </div>
      <div class="column">
      </div>
    @else
      <div class="column">
        <h1>{{ $selectedCategory->title }}</h1>
      </div>
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="{{route('catalogs.index')}}">Home</a></li>
          @if (isset($selectedCategory) && $selectedCategory->parent)
            <li class="separator">&nbsp;</li>
            <li><a href="{{ url("/catalogs/{$selectedCategory->parent->slug}") }}">{{ $selectedCategory->parent->title }}</a></li>
            <li class="separator">&nbsp;</li>
          @else
            <li class="separator">&nbsp;</li>
          @endif
          <li>{{ $selectedCategory->title }}</li>
        </ul>
      </div>
    @endif
  </div>
</div>
