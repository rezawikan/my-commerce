@if ($errors->has('quantity'))
	<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{ $errors->first('quantity') }}
	</div>
@endif