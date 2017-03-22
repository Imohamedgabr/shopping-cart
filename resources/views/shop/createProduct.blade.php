@extends('layouts.main')

@section('title')
    Laravel Shopping Cart
@endsection

@section('stylesheets')
	
	{!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Product</h1>
			<hr>

			{{-- we tell the form to allow file uploads --}}
			{!! Form::open(array('route'=>'storeproduct', 'data-parsley-validate' => '','files' =>true)) !!}
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('price', 'Price:') }}
				{{ Form::text('price', null, array('class' => 'form-control', 'required' => '', 'minlength' => '1', 'maxlength' => '250') ) }}


				 {{-- the image --}}

				{{ Form::label('featured_image', "Upload featured Image: (Required) ") }}
				{{ Form::file('featured_image') }}
				


				{{ Form::label('description', "Product Description:") }}
				{{ Form::textarea('description', null, array('class' => 'form-control')) }}

				{{ Form::submit('Create Product', array('class' => 'btn btn-success btn-lg btn-block top-margin-space')) }}
				{{ csrf_field() }}
				<input type="hidden" name="stripeToken">
			{!! Form::close() !!}
		</div>
	</div>

@endsection


@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

@endsection