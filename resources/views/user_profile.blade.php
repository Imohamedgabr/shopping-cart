@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <h1>Welcome Back {{ Auth::user()->name }}</h1>
            <hr>
            <h2>My Orders</h2>
            <div class="panel-body">
                
                @foreach($orders as $order)
                    <div class="panel panel-default">
                        <ul class="list-group">
                            @foreach($order->cart->items as $item)
                              <li class="list-group-item">
                              <span class="badge">{{$item['price']}} $ </span>
                              {{$item['item']['title'] }} <span class="badge">Amount: {{$item['qty'] }} Unit/Units</span>

                              </li>

                             @endforeach
                         </ul>

                    </div>

                    <div class="well panel-footer">
                        <strong>Total Price:  $ {{$order->cart->totalPrice}} </strong>
                    </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- <a href="{{ route('product.index') }} ">Go to Products </a> --}}

@endsection
