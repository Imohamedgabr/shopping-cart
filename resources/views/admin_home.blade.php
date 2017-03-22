@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <h1>Admin Profile</h1>
            <a href=" {{ url('/createProduct') }} ">Create Product</a>
        </div>
    </div>
</div>

{{-- <a href="{{ route('product.index') }} ">Go to Products </a> --}}

@endsection
