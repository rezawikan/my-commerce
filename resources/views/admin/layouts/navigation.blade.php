<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
              <div class="dropdown profile-element"> <span>
                  <img alt="image" class="img-circle" src="{{ asset('admin/img/profile_small.jpg')}}" />
                   </span>
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::guard('admin')->user()->name }}</strong>
                  </span> <span class="text-muted text-xs block">{{ Auth::guard('admin')->user()->roles()->first()->name }}<b class="caret"></b></span> </span> </a>
                  <ul class="dropdown-menu animated fadeInRight m-t-xs">
                      <li><a href="profile.html">Profile</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="mailbox.html">Mailbox</a></li>
                      <li class="divider"></li>
                      <li><a href="login.html">Logout</a></li>
                  </ul>
              </div>
              <div class="logo-element">
                  IN+
              </div>
          </li>
            <li class="{{ isActiveRoute('master/dashboard') }}">
                <a href="{{ url('master/dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ isActiveRoute(['master/products','master/products/trashes']) }}">
                <a href="#"><i class="fa fa-shopping-cart"></i><span class="nav-label">Products</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ isActiveRoute('master/products') }}"><a href="{{ url('master/products') }}">List of Products</a></li>
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ isActiveRoute('master/products/trashes') }}"><a href="{{ url('master/products/trashes') }}">Trashes</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">E-commerce</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="ecommerce_products_grid.html">Products grid</a></li>
                    <li><a href="ecommerce_product_list.html">Products list</a></li>
                    <li><a href="ecommerce_product.html">Product edit</a></li>
                    <li><a href="ecommerce_product_detail.html">Product detail</a></li>
                    <li><a href="ecommerce-cart.html">Cart</a></li>
                    <li><a href="ecommerce-orders.html">Orders</a></li>
                    <li><a href="ecommerce_payments.html">Credit Card form</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
