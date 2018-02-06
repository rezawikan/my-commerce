@extends('layouts.app')

@section('content')
<div class="container">
	@if ($cart->isEmpty())
	<div class="text-center">
		<p>Cart Kamu masih kosong</p>
		<p><a href="{{ url('/catalogs') }}">Lihat semua produk <i class="fa fa-arrow-right"></i></a></p>
	</div>
	@else
		@if (Session::has('message'))
			@include('part.alert', ['class' => 'alert-success', 'message' =>	session('message')])
		@endif
		<table class="cart table table-hover table-condensed">
			<caption>Cart Details</caption>
			<thead>
				<tr>
					<th style="width:40%">Produk</th>
					<th style="width:20%">Harga</th>
					<th style="width:10%">Jumlah</th>
					<th style="width:20%" class="text-center">Subtotal</th>
					<th style="width:10%">Action</th>
				</tr>
			</thead>
			<tbody>

				{{-- {{ dd($cart->details()) }} --}}
				@foreach ($cart->details() as $key => $order)
					<tr>
						<td data-th="Produk">
							<div class="row">
								<div class="col-sm-2 hidden-xs">
									<img src="{{ $order['detail']['photo'] }}" alt="">
								</div>
								<div class="col-sm-10">
									<h4 class="nomargin name">{{ $order['detail']['name'] }}</h4>
								</div>
							</div>
						</td>
						<td data-th="Harga">Rp {{ number_format($order['detail']['price'], 2) }}</td>
						<td data-th="Jumlah">
							<form style="display:inline;" action="{{ route('cart.update', ['id' => $order['id']])}}" method="POST">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								  <input type="number" class="form-control" name="quantity" value="{{ $order['quantity'] }}">
									<button type="submit"><i class="fa fa-refresh"></i></button>
								</form>
						</td>
						<td data-th="Subtotal" class="text-right">Rp {{ number_format($order['subTotal']) }}</td>
						<td data-th="aksi">

							<form style="display:inline;" action="{{ route('cart.destroy', ['id' => $order['id']])}}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								  <button type="submit" class="btn-cart-delete"><i class="fa fa-trash-o"></i></button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr class="visible-xs">
					<td class="text-right"> Total Rp {{ number_format($cart->totalPrice()) }}</td>
				</tr>
				<tr>
					<td>
						<a href="{{ url('/catalogs') }}" class="btn btn-warning"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Belanja lagi</a>
					</td>
					<td colspan="2" class="hidden-xs"></td>
					<td class="hidden-xs text-right">
						<strong>Total Rp {{ number_format($cart->totalPrice()) }}</strong>
					</td>
					<td>
						<a href="{{ url('/checkout/login') }}" class="btn btn-success btn-block">Pembayaran <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <a>
					</td>
				</tr>
			</tfoot>
		</table>
	@endif
</div>
@endsection

@push('last-scripts')
	<script type="text/javascript">
		$(document).ready(function() {

			$('.btn-get').on('click',function(e){
				e.preventDefault();

				let update = [];
				$('.cart > tbody  > tr').each(function() {
					let a = $(this).find('input[name=quantity]').val();
					update.push(a);
				});
			});

			$('.btn-cart-delete').on('click',function(e){
			e.preventDefault();

			let name = $(this).closest("tr")   // Finds the closest row <tr>
										 .find(".name")     // Gets a descendent with class="name"
										 .text();
			let form = $(this).parents('form');

			swal({
			  title: "Ada Yakin?",
			  text: "Anda akan menghapus "+name+" dari cart",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    form.submit();
			  }
			});
		});
	});
	</script>
@endpush
