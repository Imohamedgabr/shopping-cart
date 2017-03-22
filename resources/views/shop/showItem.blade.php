@extends('layouts.main')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')

	    <div class="row">
            <div class="col-md-6 col-md-offset-2">
             	<br>
             	{{-- asset puts us in the public folder directory --}}
    				<img src="{{ asset('images/'. $product->imagePath ) }} " alt="book-image" height="600" width="350">
					
                    <div class="post">
                        <h3>{{$product->title}} <span class="badge" >$ {{$product->price}} </span> </h3>
                        <p>
                          {{$product->description}}
                          
                        </p>
                        
                    </div>

                 	<div class="row bottom-margin-space">
              			<div class="col-md-6 col-md-offset-2">
						<a href=" {{ route('product.addToCart',['id'=>$product->id]) }} " class="btn btn-success pull-right btn-block top-margin-space " role="button">Add to Cart</a>

						</div>
					</div>
            </div>

            <div class="col-xs-3 col-md-3"> <!-- side bar -->
                <h3>Other Products</h3>
                 
                 <div id="rotating-item-wrapper" class="top-margin-space bottom-margin-space">
                 <img class="rotating-item" src="{{$product->imagePath}}" width="150" height="200" />
				 <img class="rotating-item" src="http://vbu.ac.in/wp-content/uploads/2015/08/books-2.png" width="150" height="200" />
				 <img class="rotating-item" src="http://www.shabnampathan.com/images/book1.jpg" width="150" height="200" />
				 <img class="rotating-item" src="http://vignette2.wikia.nocookie.net/harrypotter/images/0/00/Harry_James_Potter34.jpg/revision/latest?cb=20150826224904" width="150" height="200" />
				 <img class="rotating-item" src="http://vbu.ac.in/wp-content/uploads/2015/08/books-2.png" width="150" height="200" />
				 <img class="rotating-item" src="http://www.shabnampathan.com/images/book1.jpg" width="150" height="200" /></div>
				
				

                <a href=" {{ route('product.index') }} " class="btn btn-success pull-right btn-block top-margin-space" role="button">Back to products</a>
				
				@if (Auth::guard("admin_user")->user())

               		 <div class="col-md-6 top-margin-space">
						{!! Html::linkRoute('product.edit', 'Edit', array($product->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-md-6 top-margin-space">
						{!! Form::open(['route' => ['product.delete', $product->id], 'method' => 'DELETE']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>

					@endif
            </div>
        </div> <!-- End of header . row -- >    

@endsection

@section('scripts')


	<script type="text/javascript">
		
		$(window).load(function() { //start after HTML, images have loaded
	 
	    var InfiniteRotator =
	    {
	        init: function()
	        {
	            //initial fade-in time (in milliseconds)
	            var initialFadeIn = 2000;
	 
	            //interval between items (in milliseconds)
	            var itemInterval = 3000;
	 
	            //cross-fade time (in milliseconds)
	            var fadeTime = 2000;
	 
	            //count number of items
	            var numberOfItems = $('.rotating-item').length;
	 
	            //set current item
	            var currentItem = 0;
	 
	            //show first item
	            $('.rotating-item').eq(currentItem).fadeIn(initialFadeIn);
	 
	            //loop through the items
	            var infiniteLoop = setInterval(function(){
	                $('.rotating-item').eq(currentItem).fadeOut(fadeTime);
	 
	                if(currentItem == numberOfItems -1){
	                    currentItem = 0;
	                }else{
	                    currentItem++;
	                }
	                $('.rotating-item').eq(currentItem).fadeIn(fadeTime);
	 
	            }, itemInterval);
	        }
	    };
	 
	    InfiniteRotator.init();
	 
	});
	</script>

@endsection