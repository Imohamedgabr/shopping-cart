@extends('layouts.main')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    @if(Session::has('success'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="charge-message" class="alert alert-success">
                {{Session::get('success') }}
            </div>
        </div>
    </div>
    @endif
    
    @foreach($products->chunk(3) as $productChunk);
    
       <div class="row">
       @foreach($productChunk as $product)

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <a href="{{ route('product.showItem' ,['id'=> $product->id]) }}"> 
                <img src=" {{ asset('images/'. $product->imagePath ) }} " alt="new product" class="img" width="180" height="150"></a>
                <div class="caption">
                    <h3>{{$product->title }}</h3>
                    <p class="description"> {{substr(strip_tags($product->description), 0 ,30)}} {{strlen(strip_tags($product->description)) > 30?"..." :"" }}
                    </p>
                    <div class="clearfix">
                        <div class="pull-left price">${{$product->price }}</div>
                        <a href=" {{ route('product.addToCart',['id'=>$product->id]) }} " class="btn btn-success pull-right" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
       

       @endforeach


    @endforeach
@endsection