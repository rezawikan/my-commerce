<div class="offcanvas-container" id="shop-categories">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title">Shop Categories</h3>
  </div>
  <nav class="offcanvas-menu">
    <ul class="menu">
      @foreach (App\Models\Category::NoParent()->get() as $category)
          <li class="has-children"><span><a href="#">{{ $category->title }}</a><span class="sub-menu-toggle"></span></span>
            <ul class="offcanvas-submenu">
              @foreach ($category->childs as $child)
                  <li><a href="{{ url("/catalogs/{$child->slug}")}}">{{ $child->title }}</a></li>
              @endforeach
          </ul>
      @endforeach
        </li>
    </ul>
  </nav>
</div>
