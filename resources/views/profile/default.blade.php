@extends('layouts.app')

@section('content')
  <!-- Page Title-->
      @include('profile.breadcrumb')
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <div class="col-lg-4">
            <aside class="user-info-wrapper">
              <div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
                <div class="info-label" data-toggle="tooltip" title="You currently have 290 Reward Points to spend"><i class="icon-medal"></i>290 points</div>
              </div>
              <div class="user-info">
                <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="img/account/user-ava.jpg" alt="User"></div>
                <div class="user-data">
                  <h4>{{ auth()->user()->name }}</h4><span>Joined {{ auth()->user()->created_at->format('F j Y') }}</span>
                </div>
              </div>
            </aside>
            <nav class="list-group">
              <a class="list-group-item with-badge" href="account-orders.html"><i class="icon-bag"></i>Orders<span class="badge badge-primary badge-pill">6</span></a>
              <a class="list-group-item {{ isActiveRoute('profile') }}" href="account-profile.html"><i class="icon-head"></i>Profile</a>
              <a class="list-group-item {{ isActiveRoute('addresses') }}" href="account-address.html"><i class="icon-map"></i>Addresses</a>
              <a class="list-group-item {{ isActiveRoute('wishlist') }} with-badge" href="account-wishlist.html"><i class="icon-heart"></i>Wishlist<span class="badge badge-primary badge-pill">3</span></a>
              <a class="list-group-item {{ isActiveRoute('account-tickets') }} with-badge" href="account-tickets.html"><i class="icon-tag">

            </i>My Tickets<span class="badge badge-primary badge-pill">4</span></a>
            </nav>
          </div>
          <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <h4>General Information</h4>
            <hr class="padding-bottom-1x">
            <profile></profile>
          </div>
        </div>
      </div>
@endsection
