@extends('layouts.main')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
		
		@if(Session::has('cart'))
			<div class="row">
				<div class="col-sm-6  col-md-6 col-md-offset-3 col-sm-offset-3">
					<ul class="list-group">
						@foreach($products as $product)
							<li class="list-group-item">
								<span class="badge"> {{$product['qty'] }} </span>
								<strong> {{$product['item']['title'] }} </strong>
								<span class="label label-success">{{$product['price'] }}</span>
								<div class="btn-group" >
									<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" > Action <span class="caret"></span> </button>
									<ul class="dropdown-menu">
										<li><a href="{{ route('product.reduceByOne',['id'=>$product['item']['id']] ) }} ">Reduce by 1</a></li>
										<li><a href="{{ route('product.remove',['id'=>$product['item']['id']] ) }} ">Clear All</a></li>
									</ul>
								</div>
							</li>

						@endforeach
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6  col-md-6 col-md-offset-3 col-sm-offset-3">
					<strong>Total Price: {{$totalPrice }} </strong>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6  col-md-6 col-md-offset-3 col-sm-offset-3">
					<a type="button" href="{{ route('checkout') }} " class="btn btn-success">Check Out</a>
				</div>
			</div>

		@else
		<div class="row">
				<div class="col-sm-6  col-md-6 col-md-offset-3 col-sm-offset-3">
					<strong>No items in cart </strong>
				</div>
			</div>

		@endif

@endsection