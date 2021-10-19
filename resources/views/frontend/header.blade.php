<div class="header">
    <?php
        use App\Models\Category;
        $cate = Category::orderBy("id","asc")->get();
    ?> xem gửi đúng link ko b
                <link rel="stylesheet" type="text/css" href="{{asset('css/style1.css')}}">
				<div style="background-color:#d6ba8d;" class="header-top">
					<div class="container-fluid">
						<!-- Logo  -->
						<div class="logo">
							<img src="{{asset('images/header-logo.png')}}">
						</div>
                        <div style="position:relative;" class="cart-dropdown">
						<div class="button">
                            <div class="cart-div">
                            <a id="cart" class="cart" href="#"><img src="{{asset('images/shopping-cart.png')}}"></a>
                            @if(Session::has("Cart") != null)
                                <span style="top:1px;padding:1px 6px;" id="total-quanty-show">{{Session::get("Cart")->totalQuanty}}</span>
                            @else
                                <span style="top:1px;padding:1px 6px;" id="total-quanty-show">0</span>
                            @endif
                            </div>
                            <a class="bar" href="#"><img src="{{asset('images/bar.png')}}"></a>
                            <div class="cover"></div>
                            <div class="menu-navbar">
                                <ul class="menu-content">
                                    <li class="item"><a href="{{route('home')}}">HOME</a></li>
                                    <div class="categories">
                                        <li class="item"><a href="#">CATEGORY</a></li>
                                        <div class="category">
                                            <ul>
                                                @foreach($cate as $rows)
                                                <li><a href="#">{{$rows->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <li class="item"><a href="#">ABOUT</a></li>
                                    <li class="item"><a href="#">SERVICES</a></li>
                                    <li class="item"><a href="#">PAGES</a></li>
                                    <li class="item"><a href="#">CONTACT</a></li>
                                </ul>
                                @if (Auth::check())
                                <div class="login-regist">
                                    <div class="login"><a style="color:black">Hi,{{Auth::user()->name}}</a></div>
                                    <div class="space"><a>|</a></div>
                                    <div class="register"><a style="color:black" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} </a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                         @csrf
                                     </form>
                                    </div>
                                </div>
                                @else
                                <div class="login-regist">
                                    <div class="login"><a style="color:black" href="{{route('login')}}">Login</a></div>
                                    <div class="space"><a>|</a></div>
                                    <div class="register"><a style="color:black" href="{{route('register')}}">Register</a></div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div id="change-item-cart" style="position: absolute;" class="container-cart">
                           
                           <div class="shopping-cart">
                           @if(Session::has("Cart") != null)
                               <div class="shopping-cart-header">                                  
                                   <div class="shopping-cart-total">
                                       <span class="lighter-text">Total:</span>
                                       <span
                                           class="main-color-text">{{number_format(Session::get('Cart')->totalPrice)}}$</span>
                                   </div>
                               </div>
                               <!--end shopping-cart-header -->

                               <ul class="shopping-cart-items">
                                   @foreach(Session::get('Cart')->products as $item)
                                   <li class="clearfix">
                                       <span data-id="{{$item['productInfo']->id}}" class="del-cart"><i
                                               class="far fa-trash-alt"></i></span>
                                       <img style="width:30%;" src="{{asset('images/'.$item['productInfo']->photo)}}"
                                           alt="item1">
                                       <span class="item-name">{{$item['productInfo']->name}}</span>
                                       <span class="item-price">${{$item['productInfo']->price - $item['productInfo']->price*$item['productInfo']->discount /100}}</span>
                                       <span class="item-quantity">Quantity:{{$item['quanty']}}</span>

                                   </li>
                                   @endforeach
                               </ul>
                               
                               <input hidden id="total-quanty-cart" type="number"
                                   value="{{Session::get('Cart')->totalQuanty}}">
                               @endif
                                   <a href="{{url('/List-Cart')}}" class="checkout-view">View Cart</a>
                           </div>
                           
                               
                           <!--end shopping-cart -->
                           
                       </div>
					</div>	
				</div>
			<!-- slider -->
            <!-- end slider -->
        </div>
        <script>
              function AddCart(id) {
            $.ajax({
                url: 'http://localhost/jewels-shop/public/Add-Cart/' + id,
                type: 'GET',
            }).done(function (response) {
                RenderCart(response);
                alertify.success('Product has been added to Cart');

            });
        }
        $("#change-item-cart").on("click", ".del-cart", function () {
            $.ajax({
                url: 'http://localhost/jewels-shop/public/Delete-Item-Cart/' + $(this).data("id"),
                type: 'GET',
            }).done(function (response) {
                RenderCart(response);
                alertify.error('Product has been deleted');
            });
        });
        function RenderCart(response) {
            $("#change-item-cart").empty();
            $("#change-item-cart").html(response);
            $("#total-quanty-show").text($("#total-quanty-cart").val());
        }
        </script>