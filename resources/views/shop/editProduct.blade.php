@extends('layouts.main')

@section('title')
    Laravel Shopping Cart
@endsection

@section('stylesheets')
	
	{!! Html::style('css/parsley.css') !!}

@endsection

@section('content')


		{{-- we will make a model object and bind the model object to the form and laravel will auto fill it in the form  --}}
	<div class="row">
		<div class="row">
		{!! Form::model($product,['route' => ['product.update', $product->id], 'method' =>'PUT','files'=> true]) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

			{{ Form::label('price', 'price:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('price', null, ['class' => 'form-control']) }}

			

			
			{{-- the image --}}
			{{Form::label('featured_image', 'Update Featured Image: (Required)' , ['class' => 'top-margin-space']) }}
			{{Form::file('featured_image') ,['required' => ''] }}

			
			{{ Form::label('description', "description:", ['class' => 'top-margin-space']) }}
			{{ Form::textarea('description', null, ['class' => 'form-control']) }}
		</div>


		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Create At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($product->created_at)) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($product->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('product.index', 'Cancel', array($product->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{{Form::submit('Save Changes',['class' => 'btn btn-success btn-block'])}}
						
					</div>
				</div>

			</div>
		</div>
		{!! Form::close() !!}

	</div>{{-- end of row form --}}
	<br>

@endsection

@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

@endsection