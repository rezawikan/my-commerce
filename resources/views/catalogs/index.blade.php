@extends('layouts.app')

@section('content')
  <!-- Page Title-->
      @include('catalogs.breadcrumb')
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <div class="row">
          <!-- Products-->
          <div class="col-xl-9 col-lg-8 order-lg-2">
            <!-- Shop Toolbar-->
            <div class="shop-toolbar padding-bottom-1x mb-2">
              <div class="column">
                <div class="shop-sorting">
                  <label for="sorting">Sort by:</label>
                  <select class="form-control" id="sorting" onchange="location=this.value">
                    {{-- <option >Popularity</option> --}}
                    <option value={{ appendQueryString(['sort' => 'price', 'order' => 'asc']) }} {{isQueryString(['sort' => 'price', 'order' => 'asc']) ? 'selected' : ''}}>Low - High Price</option>
                    <option value={{ appendQueryString(['sort' => 'price', 'order' => 'desc']) }} {{isQueryString(['sort' => 'price', 'order' => 'desc']) ? 'selected' : ''}}>High - Low Price</option>
                    <option value={{ appendQueryString(['sort' => 'name', 'order' => 'asc']) }} {{isQueryString(['sort' => 'name', 'order' => 'asc']) ? 'selected' : ''}}>A - Z Order</option>
                    <option value={{ appendQueryString(['sort' => 'name', 'order' => 'desc']) }} {{isQueryString(['sort' => 'name', 'order' => 'desc']) ? 'selected' : ''}}>Z - A Order</option>
                    <option>Avarage Rating</option>
                  </select><span class="text-muted">Showing:&nbsp;</span><span>{{ $products->firstItem() }} - {{ $products->lastItem() }} items</span>
                </div>
              </div>
              <div class="column">
                <div class="shop-view"><a class="grid-view active" href="shop-grid-ls.html"><span></span><span></span><span></span></a><a class="list-view" href="shop-list-ls.html"><span></span><span></span><span></span></a></div>
              </div>
            </div>
            <!-- Products Grid-->
            <div class="isotope-grid cols-3 mb-2">
              <div class="gutter-sizer"></div>
              <div class="grid-sizer"></div>
              <!-- Product-->
              @forelse ($products as $product)
                <div class="grid-item">
                  <div class="product-card">
                    <div class="product-badge text-danger">50% Off</div>
                    <a class="product-thumb" href="catalogs/{{ $product->categories->first()->slug }}/{{ $product->slug }}">
                      <img src="{{ asset('/img/shop/products/01.jpg') }}" alt="Product"></a>
                    <h3 class="product-title"><a href="shop-single.html">{{ $product->name }}</a></h3>
                    <h4 class="product-price" >
                      <del>{{ number_format($product->price,0,',','.') }}</del>$49.99
                    </h4>
                    <div class="product-buttons">
                      @if (Auth::check())
                        <wishlist
                        :wishlisted={{ $product->wishlisted() ? 'true' : 'false' }}
                        :product={{ $product->id }}
                        ></wishlist>
                      @else
                        <button class="btn btn-outline-secondary btn-sm btn-wishlist-guest" title="Whishlist"><i class="icon-heart"></i></button>
                      @endif

                      <addcart id-cart={{ $product->id }}></addcart>
                    </div>
                  </div>
                </div>
              @empty
                @if (isset($search))
                  <h1>:()</h1>
                  @if (isset($selectedCategory))
                    <p><a href="{{ url('/catalogs?search=' . $search) }}">Cari di semua kategori <i class="fa fa-arrow-right"></i></a></p>
                  @endif
                @else
                  asdasd
                @endif
              @endforelse
            </div>
            <!-- Pagination-->
            <nav class="pagination">
              <div class="column">
                {{ $products->appends(['category' => $category, 'search' => $search, 'sort' => $sort, 'order' => $order])->links('vendor.pagination.bootstrap-4') }}
                {{-- <ul class="pages">
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li>...</li>
                  <li><a href="#">12</a></li>
                </ul>
 --}}              </div>
              @if(!$products->lastPage())
                <div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm" href="{{ $products->nextPageUrl() }}">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
              @else
                <div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm disabled" href="#">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
              @endif
            </nav>
          </div>
          <!-- Sidebar          -->
          <div class="col-xl-3 col-lg-4 order-lg-1">
            <aside class="sidebar">
              <div class="padding-top-2x hidden-lg-up"></div>
              <!-- Widget Categories-->
              {{-- <categories :data={{}}></categories> --}}

              <section class="widget widget-categories">
                <h3 class="widget-title">Shop Categories</h3>
                <ul>
                  {{-- {{dd(App\Models\Category::NestedCategory())}} --}}
                  @foreach (App\Models\Category::NoParent()->get() as $category)
                    <li class="has-children expanded"><a href="#">{{ $category->title }}</a>
                      <ul>
                      @foreach ($category->childs as $child)
                            <li>
                              <a href="{{ url('catalogs/'.$child->slug )}}">{{ $child->title }}</a>
                              <span>({{ $child->total_products }})</span>
                            </li>
                      @endforeach
                      </ul>
                  @endforeach
                    </li>
                </ul>
              </section>
              <!-- Widget Price Range-->
              @include('catalogs.price_range')
              <!-- Widget Brand Filter-->
              {{-- <section class="widget">
                <h3 class="widget-title">Filter by Brand</h3>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">Adidas&nbsp;<span class="text-muted">(254)</span></span>
                </label>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">Bilabong&nbsp;<span class="text-muted">(39)</span></span>
                </label>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">Calvin Klein&nbsp;<span class="text-muted">(128)</span></span>
                </label>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">Nike&nbsp;<span class="text-muted">(310)</span></span>
                </label>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">Tommy Bahama&nbsp;<span class="text-muted">(42)</span></span>
                </label>
              </section> --}}
              <!-- Widget Size Filter-->
              {{-- <section class="widget">
                <h3 class="widget-title">Filter by Size</h3>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">XL&nbsp;<span class="text-muted">(208)</span></span>
                </label>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">L&nbsp;<span class="text-muted">(311)</span></span>
                </label>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">M&nbsp;<span class="text-muted">(485)</span></span>
                </label>
                <label class="custom-control custom-checkbox d-block">
                  <input class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span><span class="custom-control-description">S&nbsp;<span class="text-muted">(213)</span></span>
                </label>
              </section> --}}
              <!-- Promo Banner-->
              <section class="promo-box" style="background-image: url(img/banners/02.jpg);">
                <!-- Choose between .overlay-dark (#000) or .overlay-light (#fff) with default opacity of 50%. You can overrride default color and opacity values via 'style' attribute.--><span class="overlay-dark" style="opacity: .45;"></span>
                <div class="promo-box-content text-center padding-top-3x padding-bottom-2x">
                  <h4 class="text-light text-thin text-shadow">New Collection of</h4>
                  <h3 class="text-bold text-light text-shadow">Sunglassess</h3><a class="btn btn-sm btn-primary" href="#">Shop Now</a>
                </div>
              </section>
            </aside>
          </div>
        </div>
      </div>
@endsection

@push('last-scripts')

   @if (session('added'))
      <script type="text/javascript">
        swal({
          title: "Success",
          text: "Adding product {{ session('added') }} to cart!",
          icon: "success",
          buttons: {
              cancel: {
                text: "Lanjutkan Belanja",
                value: 'cancel',
                visible: true,
                className: "",
                closeModal: true
            },
              confirm: {
                text: "Konfirmasi Pesanan",
                value: 'true',
                visible: true,
                className: "",
                closeModal: true
            }
          },
        }).then((value) => {
            switch (value) {

                case "cancel":
                  break;

                case "true":
                  window.location = '/cart';

                default:
                  break;
              }
        });
      </script>
  @endif
@endpush
