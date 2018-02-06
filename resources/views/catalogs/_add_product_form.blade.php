<form class="" action="{{ route('cart.store') }}" method="POST">
  {{ csrf_field() }}
  <div class="input-group">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="number" name="quantity" class="form-control" placeholder="Quantity - min 1pcs">
    <span class="input-group-btn"><button type="submit" class="btn btn-default">Add Cart</button></span>
  </div>
</form>
