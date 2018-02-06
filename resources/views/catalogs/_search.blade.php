<div class="panel panel-default">
  <div class="panel-heading">
    <div class="panel-title">
      Cari Produk
    </div>
    <div class="panel-body">
      <form class="" href="{{url('catalogs/'.$category)}}" method="GET">
        <div class="input-group">
          <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
