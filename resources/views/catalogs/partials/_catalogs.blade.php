<div class="grid-item">
  <div class="product-card">
    <div class="product-badge text-danger">50% Off</div>
    {{-- {{dd($product->slug)}} --}}
    {{-- <a class="product-thumb" href="{{ url("/catalogs/{$product->categories->first()->slug}/{$product->slug}") }}"> --}}
      <img src="{{ asset('/img/shop/products/01.jpg') }}" alt="Product"></a>
    <h3 class="product-title"><a href="shop-single.html">{{ $product->name }}</a></h3>
    <h4 class="product-price" >
      <del>{{ number_format($product->price,0,',','.') }}</del>$49.99
    </h4>
    <div class="product-buttons">
      {{-- @if (Auth::check())
        <wishlist
        :wishlisted={{ $product->wishlisted() ? 'true' : 'false' }}
        :product={{ $product->id }}
        ></wishlist>
      @else
        <button class="btn btn-outline-secondary btn-sm btn-wishlist-guest" title="Whishlist"><i class="icon-heart"></i></button>
      @endif --}}

      {{-- <addcart id-cart={{ $product->id }}></addcart> --}}
    </div>
  </div>
</div>
