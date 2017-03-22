@extends('layouts.main')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
		
		<div class="row">
			<div class="col-sm-6  col-md-4 col-md-offset-4 col-sm-offset-3">
				<h1>Check Out</h1>
				<h4>Your Total: ${{$total }} </h4>
				<form action="{{ route('checkout') }}" method="post" id="payment-form">
				<span class="payment-errors"></span>
				<div  id="charge-error" class="alert alert-danger {{!Session::has('error')? 'hidden' : '' }}"  >
					{{Session::get('error') }}
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" id="name" class="form-control" required name="name">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="Address">Address</label>
							<input type="text" id="address" class="form-control" required name="address">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="card-name">Card Holder Name</label>
							<input type="text" id="card-name" data-stripe="customer" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="card-number">Credit Card Number</label>
							<input type="text" size="20" data-stripe="number" id="card-number" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 form-group">
  						  <label for="Expiration month">Expiration Month</label>
     
    					  <input type="text"  data-stripe="exp_month" id="card-expiry-month" class="form-control" required>
     				</div>
    				<div class="col-xs-6 form-group">
   						 <label for="Expiration year">Expiry Year</label>
   						 <input type="text" data-stripe="exp_year" id="card-expiry-year" class="form-control" required>
 					 </div>
  				</div>

					<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="card-cvc">CVC</label>
							<input type="text"  data-stripe="cvc" id="card-cvc" class="form-control" required>
						</div>
					</div>
					</div>
				{{ csrf_field() }}
				<input type="hidden" name="stripeToken">
				<button type="submit" class="btn btn-success" value="Submit Payment">Buy Now </button>
				</form>

			</div>

		</div>

@endsection

@section('scripts')
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript" src="{{ URL::to('js/checkout.js') }} "></script>

@endsection