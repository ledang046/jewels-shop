@extends("frontend.layout")
@section("do-du-lieu")
<!--Sử dụng khi k dùng form submit -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Css -->
<link rel="stylesheet" href="{{asset('css/product-detail.css')}}">
<!-- Boostrap cdn -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- End Boostrap cdn -->

<div style="margin-top:100px" class="container-fuild">
<div style="padding: 10px 10px;" class="card text-left"><a href="{{route('home')}}">Back to shop</a></div>
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-5">
						<div class="product-image mr-5">
						  <img  width="65%" src="{{asset('images/'.$record->photo)}}" />
						</div>
					</div>
					<div class="details col-md-7">
						<h3 class="product-title">{{$record->name}}</h3>
						<div class="rating">
							<div class="stars">
							<ul class="list-inline" title="Average Rating">
								@for($count=1;$count<=5;$count++)
								@php
									if($count<=$rating){
										$check = 'checked';
									}else{
										$check = '';
									}
								@endphp
								<li style="cursor:pointer;font-size:20px;">
								<span class="fa fa-star {{$check}}"></span>
								</li>
								@endfor
								
							</ul>
							</div>
							<span class="review-no">Category: {{$record->category->name}}</span>
						</div>
						<p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
						<h4 class="price">current price: <span>${{$record->price}}</span></h4>
						<p class="vote"><strong>Discount: {{$record->discount}}%.</strong> Price reduced to <strong>{{$record->price  - ($record->price * $record->discount / 100)}}$</strong></p>
						<h5 class="sizes">Hot:
							@if($record->hot == 1)
							<span class="size" data-toggle="tooltip" title="small">
								<i class="fas fa-check ml-3" style="color:green"></i>
							</span>
							@else
							<span class="size" data-toggle="tooltip" title="small">
								<i class="fas fa-times ml-3" style="color:red"></i>
							</span>
							@endif
						</h5>
						<div class="action">
							<a id="cartbtn" class="add-to-cart btn btn-default" style="color:white;" href="javascript:"
                                                onclick="AddCart({{$record->id}})"
                                                href="{{url('/Add-Cart/'.$record->id)}}">add to cart</a>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>
						
					</div>
				</div>
			</div>
		</div>
			<div class="container ">
				<div class="row tablist">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Average Rating</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
						</li>
					</ul>
				</div>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="content-1">
							<ul class="list-inline" title="Average Rating">
								@for($count=1;$count<=5;$count++)
								@php
									if($count<=$rating){
										$color = 'color:#ffcc00;';
									}else{
										$color = 'color:#ccc;';
									}
								@endphp
								<li title="star" id="{{$record->id}}-{{$count}}" data-index="{{$count}}" 
									 data-product_id="{{$record->id}}"
									 data-rating="{{$rating}}" class="rating"
								style="cursor:pointer;{{$color}};font-size:30px;">
								&#9733;
								</li>
								@endfor
								
							</ul>
						</div>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="content-2">This is content two</div>
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<div class="content-3">This is content three</div>
					</div>
				</div> 
			</div>
	</div>
	<script>
		// Sử dụng khi k dùng form submit
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
		$('#myTab a').on('click', function(e) {
			e.preventDefault()
			$(this).tab('show')
		});
		function remove_background(product_id)
		{
			for(var count = 1;count <= 5; count++)
			{
				$('#' + product_id + '-' + count).css('color','#ccc');
			}
		}
		//hover chuột đánh giá sao 
		$(document).on('mouseenter','.rating',function(){
			var index = $(this).data('index');
			var product_id = $(this).data('product_id');
			remove_background(product_id);
			for(var count=1; count <= index;count++)
			{
				$('#' +product_id+ '-'+count).css('color','#ffcc00');
			}
		});
		$(document).on('mouseleave','.rating',function(){
			var product_id = $(this).data('product_id');
			var rating = $(this).data('rating');
			remove_background(product_id);
			for(var count=1;count <= rating;count++)
			{
				$('#' +product_id+ '-'+count).css('color','#ffcc00');
			}
		});
		$(document).on('click','.rating',function(){
			var index = $(this).data('index');
			var product_id = $(this).data('product_id');
			$.ajax({
				url:"{{url('insert-rating')}}",
				method:"POST",
				data:{index:index,product_id:product_id},
				success:function(data){
					if(data == 'done'){
						alert("You have rated " + index + " out of 5 stars!");
					}
					else{
						alert("Rating fail");
					}
				}
			});
		});
	</script>
@endsection
