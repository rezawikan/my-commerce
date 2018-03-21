@extends('layouts.app')

@section('content')
  <!-- Page Title-->
      @include('catalogs.breadcrumb')

      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-1">
        <div class="row">
          <!-- Poduct Gallery-->
          <div class="col-md-6">
            <div class="product-gallery"><span class="product-badge text-danger">30% Off</span>
              <div class="gallery-wrapper">
                @foreach ($product->images as $key => $value)
                  <div class="gallery-item {{ $loop->first ? 'active' : '' }}"><a href="{{ asset('storage/'.$value->path) }}" data-hash="#{{ $key }}" data-size="1000x667"></a></div>
                @endforeach
                {{-- <div class="gallery-item"><a href="img/shop/single/05.jpg" data-hash="five" data-size="1000x667"></a></div> --}}
              </div>
              <div class="product-carousel owl-carousel">
                @foreach ($product->images as $key => $value)
                  <div data-hash="#{{ $key }}"><img src="{{ asset('storage/'.$value->path) }}" alt="Product"></div>
                @endforeach
              </div>
              <ul class="product-thumbnails">
                @foreach ($product->images as $key => $value)
                  <li class="{{ $loop->first ? 'active' : '' }}"><a href="#{{ $key }}"><img src="{{ asset('storage/'.$value->path) }}" alt="Product"></a></li>
                @endforeach
              </ul>
            </div>
          </div>
          <!-- Product Info-->
          <div class="col-md-6">
            <div class="padding-top-2x mt-2 hidden-md-up"></div>
              <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i>
              </div><span class="text-muted align-middle">&nbsp;&nbsp;{{ round($product->averageRating, 2) }} | {{ $product->ratings->count() }}  customer reviews</span>
            <h2 class="padding-top-1x text-normal">{{ $product->name }}</h2><span class="h2 d-block">
              <del class="text-muted text-normal">$68.00</del>&nbsp; $47.60</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta voluptatibus quos ea dolore rem, molestias laudantium et explicabo assumenda fugiat deserunt in, facilis laborum excepturi aliquid nobis ipsam deleniti aut? Aliquid sit hic id velit qui fuga nemo suscipit obcaecati. Officia nisi quaerat minus nulla saepe aperiam sint possimus magni veniam provident.</p>
            <div class="row margin-top-1x">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="size">Men's size</label>
                  <select class="form-control" id="size">
                    <option>Chooze size</option>
                    <option>11.5</option>
                    <option>11</option>
                    <option>10.5</option>
                    <option>10</option>
                    <option>9.5</option>
                    <option>9</option>
                    <option>8.5</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="color">Choose color</label>
                  <select class="form-control" id="color">
                    <option>White/Red/Blue</option>
                    <option>Black/Orange/Green</option>
                    <option>Gray/Purple/White</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <select class="form-control" id="quantity">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="pt-1 mb-2"><span class="text-medium">SKU:</span> #21457832</div>
            <div class="padding-bottom-1x mb-2"><span class="text-medium">Categories:&nbsp;</span>
              @foreach ($product->categories as $key => $value)
                <a class="navi-link" href="{{ $value->slug }}">{{ $value->title }}</a>
              @endforeach
            </div>
            <hr class="mb-3">
            <div class="d-flex flex-wrap justify-content-between">
              <div class="entry-share mt-2 mb-2"><span class="text-muted">Share:</span>
                <div class="share-links"><a class="social-button shape-circle sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus" href="#" data-toggle="tooltip" data-placement="top" title="Google +"><i class="socicon-googleplus"></i></a></div>
              </div>
              <div class="sp-buttons mt-2 mb-2">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-primary" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-bag"></i> Add to Cart</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Product Tabs-->
        <div class="row padding-top-3x mb-3">
          <div class="col-lg-10 offset-lg-1">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab" role="tab">Description</a></li>
              <li class="nav-item"><a class="nav-link" href="#reviews" data-toggle="tab" role="tab">Reviews ({{ $product->ratings->count() }})</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="description" role="tabpanel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error blanditiis a, deserunt magnam pariatur quam suscipit quae. Veniam, deserunt reprehenderit quasi hic recusandae itaque omnis fugiat animi architecto facilis repellendus. Commodi dolorem, eius consectetur. Amet maiores nemo at nobi s aspernatur velit, sequi odio, a veritatis inventore autem esse provident in? Placeat, sunt!</p>
                <p class="mb-30">Iste assumenda, vitae, aliquam excepturi libero quia ullam quisquam tenetur id sint labore. Pariatur praesentium velit, fugit facere maxime voluptates optio qui? Quidem obcaecati necessitatibus rem aspernatur, mollitia, assumenda explicabo numquam minus eos sapiente totam dicta, laborum dolorum! Vitae distinctio quos non ut fugiat.</p>
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="//www.youtube.com/embed/B81qd2v6alw?rel=0" allowfullscreen></iframe>
                </div>
              </div>
              <div class="tab-pane fade" id="reviews" role="tabpanel">
                @foreach ($product->ratings as $key => $value)
                  <div class="comment">
                    <div class="comment-author-ava"><img src="img/reviews/01.jpg" alt="Review author"></div>
                    <div class="comment-body">
                      <div class="comment-header d-flex flex-wrap justify-content-between">
                        <h4 class="comment-title">Average quality for the price</h4>
                        <div class="mb-2">
                            <div class="rating-stars">
                              @for ($i=0; $i < 5; $i++)
                                @if ($i < $value->rating)
                                    <i class="icon-star filled"></i>
                                @else
                                  <i class="icon-star"></i>
                                @endif
                              @endfor
                            </div>
                        </div>
                      </div>
                      <p class="comment-text">{{ $value->comment }}</p>
                      <div class="comment-footer"><span class="comment-meta">{{ App\Models\User::find($value->user_id)->first()->name }}</span></div>
                    </div>
                  </div>
                @endforeach

                <!-- Review Form-->
                <h5 class="mb-30 padding-top-1x">Leave Review</h5>
                <form class="row" method="POST">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="review_subject">Subject</label>
                      <input class="form-control form-control-rounded" type="text" id="review_subject" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="review_rating">Rating</label>
                      <select class="form-control form-control-rounded" id="review_rating">
                        <option>5 Stars</option>
                        <option>4 Stars</option>
                        <option>3 Stars</option>
                        <option>2 Stars</option>
                        <option>1 Star</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="review_text">Review </label>
                      <textarea class="form-control form-control-rounded" id="review_text" rows="8" required></textarea>
                    </div>
                  </div>
                  <div class="col-12 text-right">
                    <button class="btn btn-outline-primary" type="submit">Submit Review</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Related Products Carousel-->
        <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">You May Also Like</h3>
        <!-- Carousel-->
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card">
              <div class="product-badge text-danger">22% Off</div><a class="product-thumb" href="shop-single.html"><img src="img/shop/products/09.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Rocket Dog</a></h3>
              <h4 class="product-price">
                <del>$44.95</del>$34.99
              </h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card">
                <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i>
                </div><a class="product-thumb" href="shop-single.html"><img src="img/shop/products/03.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Oakley Kickback</a></h3>
              <h4 class="product-price">$155.00</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card"><a class="product-thumb" href="shop-single.html"><img src="img/shop/products/12.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Vented Straw Fedora</a></h3>
              <h4 class="product-price">$49.50</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card">
                <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i>
                </div><a class="product-thumb" href="shop-single.html"><img src="img/shop/products/11.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Top-Sider Fathom</a></h3>
              <h4 class="product-price">$90.00</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card"><a class="product-thumb" href="shop-single.html"><img src="img/shop/products/04.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Waist Leather Belt</a></h3>
              <h4 class="product-price">$47.00</h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
          </div>
          <!-- Product-->
          <div class="grid-item">
            <div class="product-card">
              <div class="product-badge text-danger">50% Off</div><a class="product-thumb" href="shop-single.html"><img src="img/shop/products/01.jpg" alt="Product"></a>
              <h3 class="product-title"><a href="shop-single.html">Unionbay Park</a></h3>
              <h4 class="product-price">
                <del>$99.99</del>$49.99
              </h4>
              <div class="product-buttons">
                <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
              </div>
            </div>
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
