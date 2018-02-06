<section class="widget widget-categories">
  <h3 class="widget-title">Price Range</h3>
  <form class="price-range-slider" href="{{ url('catalogs/'.$category )}}" method="GET" data-start-min="{{ $min }}" data-start-max="{{ $max }}" data-min="{{ App\models\Product::min('price') }}" data-max="{{ App\models\Product::max('price') }}" data-step="1">
    <div class="ui-range-slider"></div>
    <footer class="ui-range-slider-footer">
      <div class="column">
        <button class="btn btn-outline-primary btn-sm" type="submit">Filter</button>
      </div>
      <div class="column">
        <div class="ui-range-values">
          <div class="ui-range-value-min"><span></span>
            <input type="hidden" name="min" >
          </div>&nbsp;-&nbsp;
          <div class="ui-range-value-max" ><span></span>
            <input type="hidden" name="max">
          </div>
        </div>
      </div>
    </footer>
  </form>
</section>
