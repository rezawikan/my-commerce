<h3>{{ $product->name }}</h3>
<div class="thumbnail">
  <img src="{{ asset('storage/'.$product->photo) }}" class="img-rounded" alt="">
  <p>Model : {{ $product->model }}</p>
  <p>Harga : <strong>IDR {{ number_format($product->price, 2) }}</strong></p>
  <p>Category :
    @foreach ($product->categories as $category)
      <span class="label label-primary m-r-xs">
          <i class="fa fa-btn fa-tags"></i>
          {{ $category->title }}
      </span>
    @endforeach
  </p>

  @if (Auth::check())
       <wishlist
       :wishlisted={{ $product->wishlisted() ? 'true' : 'false' }}
       :product={{ $product->id }}
       ></wishlist>
  @endif

  @can ('customer')
     @include('catalogs._add_product_form')
  @else
    @if (auth()->guest())
        @include('catalogs._add_product_form')
    @endif
  @endcan


</div>
