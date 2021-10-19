<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonfire | Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <!-- Add css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/slick-theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style1.css')}}">
    <!-- Boostrap 4 cdn -->
    
    <!-- Add script -->
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
	<script src="{{asset('js/slick.min.js')}}"></script>
	<script src="{{asset('js/script.js')}}"></script>
    
    <!-- Alertify Js -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <!-- End alertify js -->
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <?php
        use App\Models\Category;
        $cate = Category::orderBy("id","asc")->get();
    ?>
            <div class="header-top">
                <div class="container-fluid">
                    <!-- Logo  -->
                    <div class="logo">
                        <img src="images/header-logo.png">
                    </div>
                    <div style="position:relative;" class="cart-dropdown">
                        <div class="button">
                            <div class="cart-div">
                            <a id="cart" class="cart" href="#"><img src="images/shopping-cart.png"></a>
                            @if(Session::has("Cart") != null)
                                <span id="total-quanty-show">{{Session::get("Cart")->totalQuanty}}</span>
                            @else
                                <span id="total-quanty-show">0</span>
                            @endif
                            </div>
                            <a class="bar" href="#"><img src="images/bar.png"></a>
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
                                    <div class="login"><a>Hi,{{Auth::user()->name}}</a></div>
                                    <div class="space"><a>|</a></div>
                                    <div class="register"><a href="{{ route('logout') }}"
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
                                    <div class="login"><a href="{{route('login')}}">Login</a></div>
                                    <div class="space"><a>|</a></div>
                                    <div class="register"><a href="{{route('register')}}">Register</a></div>
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
                        <!--end container -->
                    </div>
                </div>
            </div>
            <!-- slider -->
            <div class="slider">
                <!-- slick -->
                <div class="slick">
                    <!-- all slider-items -->
                    <div class="slider-item">
                        <!-- slider-img -->
                        <div class="slider-img">
                            <img src="images/Banner.jpg" alt="slider-item-1">
                            <!-- slider-content -->
                            <div class="slider-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col date">Spring 2017</div>
                                        <div class="col title">it’s your<br>shine time</div>
                                        <div class="col btn">
                                            <a href="#" class="discover-btn">discover now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider-content -->
                        </div>
                        <!-- slider-img -->
                    </div>
                    <div class="slider-item">
                        <!-- slider-img -->
                        <div class="slider-img">
                            <img src="images/Banner.jpg" alt="slider-item-2">
                            <!-- slider-content -->
                            <div class="slider-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col date">Spring 2017</div>
                                        <div class="col title">it’s your<br>shine time</div>
                                        <div class="col btn">
                                            <a href="#" class="discover-btn">discover now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end slider-content -->
                        </div>
                        <!-- slider-img -->
                    </div>
                    <!-- end all slider-items -->
                </div>
                <!-- end slick -->
                <!-- slider-social -->
                <div class="list-content">
                    <!-- social-list -->
                    <ul class="social-list">
                        <li><a href="#" class="item">Facebook</a></li>
                        <li><a href="#" class="item">Twitter</a></li>
                        <li><a href="#" class="item">Instagram</a></li>
                        <li><a href="#" class="item">Youtube</a></li>
                    </ul>
                    <!-- end social-list -->
                </div>
                <!-- end slider-social -->
            </div>
            <!-- end slider -->
        </div>
        <!-- End Header -->
        <div class="page-main">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Strength -->
                <div class="strength">
                    <div class="container">
                        <div class="row">
                            <div class="col freeship">
                                <div class="title">free shipping</div>
                                <div class="content">All order over $300</div>
                            </div>
                            <div class="col support">
                                <div class="title">support customer</div>
                                <div class="content">Support 24/7</div>
                            </div>
                            <div class="col payment">
                                <div class="title">secure payments</div>
                                <div class="content">Support 24/7</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Strength -->
                <!-- Banner -->
                <div class="banner">
                    <!-- Title -->
                    <div class="container">
                        <div class="row">
                            <div class="col title">It started with a simple idea: Create quality, well-designed
                                products that I wanted myself.</div>
                        </div>
                    </div>
                    <!-- End Title -->
                    <!-- Banner item -->
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="col-fluid small">
                                <img src="images/feature-item-1.jpg" alt="feature-item-1">
                                <div class="detail item-1">
                                    <div class="name">Gold Leaf Ring</div>
                                    <div class="price">$179.00</div>
                                </div>
                            </div>
                            <div class="col-fluid big">
                                <img src="images/feature-item-2.jpg" alt="feature-item-2">
                                <div class="detail item-2">
                                    <div class="title">sale up to</div>
                                    <div class="percent">70%</div>
                                    <div class="content">Select Gold Clearance</div>
                                    <div class="shop-btn">shop now</div>
                                </div>
                                <div class="rectangle"></div>
                            </div>
                            <div class="col-fluid small">
                                <img src="images/feature-item-3.jpg" alt="feature-item-3">
                                <div class="detail item-3">
                                    <div class="title">new collection</div>
                                    <div class="content">Leaf&nbsp;&nbsp;Ring</div>
                                </div>
                            </div>
                            <div class="col-fluid small">
                                <img src="images/feature-item-4.jpg" alt="feature-item-4">
                            </div>
                            <div class="col-fluid small">
                                <img src="images/feature-item-5.jpg" alt="feature-item-5">
                                <div class="detail item-5">
                                    <div class="name">Rose Gold Necklaces</div>
                                    <div class="price">$179.00</div>
                                </div>
                            </div>
                            <div class="col-fluid big">
                                <img src="images/feature-item-6.jpg" alt="feature-item-6">
                                <div class="detail item-6">
                                    <div class="title">Princess Ring<br>Rose Gold</div>
                                    <div class="content">Rose gold plated over brass<br>* One size</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner item -->
                    <!-- End Banner -->
                </div>
                <!-- End Banner -->
                <!-- feature products -->
                <div class="feature-products">
                    <div class="container">
                        <!-- heading -->
                        <div class="heading">
                            <div class="name">Featured items</div>
                            <div class="more-btn"><a href="#">VIEW MORE <i class="fas fa-play-circle"></i></a></div>
                        </div>
                        <!-- end heading -->
                        <!-- product-list-->

                        <div class="row">
                            @foreach($data as $rows)
                            <div class="col product-item">
                                <!-- product-image-slider -->
                                <div class="product-image-slider">
                                    <div class="slick">
                                        <div><img src="images/{{$rows->photo}}" alt="feature-product-1-img-1"></div>
                                        <div><img src="images/{{$rows->photo}}" alt="feature-product-1-img-1"></div>
                                    </div>
                                    <div class="action">

                                        <div class="addcart"><a style="color:white;" href="javascript:"
                                                onclick="AddCart({{$rows->id}})"
                                                href="{{url('/Add-Cart/'.$rows->id)}}">ADD TO CART</a></div>
                                        <div class="icon add-wishlist"><i class="far fa-heart"></i></div>
                                        <div class="icon compare"><a href="{{url('/show-detail/'.$rows->id)}}"><i class="fas fa-eye"></i></a></div>
                                        <div class="icon quick-view"><i class="fas fa-search"></i></div>
                                    </div>
                                </div>
                                <!-- end product-image-slider -->
                                <div class="product-info">
                                    <div class="name">{{$rows->name}}</div>
                                    <div class="price">${{$rows->price}}.00</div>
                                    @if(!$rows->discount == "")
                                    <div style="font-size:12px" class="name"> Discount: {{$rows->discount}}%</div>
                                    @else
                                    <div style="font-size:12px" class="name"> Discount: 0%</div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- end product-list -->
                    </div>
                </div>
                <!-- end feature-products -->
                <!-- blog -->
                <div class="blog">
                    <div class="container">
                        <div class="heading"><span>Blog update</span></div>
                        <div class="row">
                            <div class="col blog-item">
                                <div class="background">
                                    <img src="images/blog-1.jpg" alt="blog-item-1">
                                    <div class="content">
                                        <div class="date">JULY 14TH, 2016</div>
                                        <div class="title">8 Things I’ve Learned from 8 Years of Bonfire</div>
                                    </div>
                                    <div class="interaction">
                                        <div class="view"><i class="fas fa-eye"></i>941 Views</div>
                                        <div class="like"><i class="fas fa-share-alt"></i>27 Likes</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col blog-item">
                                <div class="background">
                                    <img src="images/blog-2.jpg" alt="blog-item-2">
                                    <div class="content">
                                        <div class="date">JULY 14TH, 2016</div>
                                        <div class="title">How I Stay Inspired and Come Up with New Ideas</div>
                                    </div>
                                    <div class="interaction">
                                        <div class="view"><i class="fas fa-eye"></i>941 Views</div>
                                        <div class="like"><i class="fas fa-share-alt"></i>27 Likes</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col blog-item">
                                <div class="background">
                                    <img src="images/blog-3.jpg" alt="blog-item-3">
                                    <div class="content">
                                        <div class="date">JULY 14TH, 2016</div>
                                        <div class="title">Wait, there’s a human on the other end?</div>
                                    </div>
                                    <div class="interaction">
                                        <div class="view"><i class="fas fa-eye"></i>941 Views</div>
                                        <div class="like"><i class="fas fa-share-alt"></i>27 Likes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-btn"><span>Go to blog</span></div>
                    </div>
                </div>
                <!-- end blog -->
                <!-- brand -->
                <div class="brands">
                    <div class="container">
                        <div class="row">
                            <div class="col .brand-item">
                                <div class="image"><img src="images/Rolex_Logo.png" alt="brand-logo-1"></div>
                            </div>
                            <div class="col .brand-item">
                                <div class="image"><img src="images/elle-logo.png" alt="brand-logo-2"></div>
                            </div>
                            <div class="col .brand-item">
                                <div class="image"><img src="images/download.png" alt="brand-logo-3"></div>
                            </div>
                            <div class="col .brand-item">
                                <div class="image"><img src="images/logo-jubilee.png" alt="brand-logo-4"></div>
                            </div>
                            <div class="col .brand-item">
                                <div class="image"><img src="images/TritonLogo_URL-AllBlack.png" alt="brand-logo-5">
                                </div>
                            </div>
                            <div class="col .brand-item">
                                <div class="image"><img src="images/pandora.png" alt="brand-logo-6"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end brand -->
            </div>
        </div>
        <!-- End Main Content -->
        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <!-- footer top -->
                <div class="footer-top">
                    <!-- logo -->
                    <div class="logo">
                        <img src="images/logo-2.png" alt="footer-logo">
                    </div>
                    <!-- end logo -->
                    <!-- nav -->
                    <nav>
                        <a href="#" class="nav-item active">home</a>
                        <a href="#" class="nav-item">about</a>
                        <a href="#" class="nav-item">services</a>
                        <a href="#" class="nav-item">portfolio</a>
                        <a href="#" class="nav-item">pages</a>
                        <a href="#" class="nav-item">contact</a>
                    </nav>
                    <!-- end nav -->
                    <!-- subscribe -->
                    <div class="subscribe">subscribe<i class="fas fa-envelope"></i></div>
                    <!-- end subscribe -->
                </div>
                <!-- footer top -->
                <!-- footer-bottom -->
                <div class="footer-bottom">
                    <!-- contact -->
                    <div class="contact">
                        <div class="info">14 L.E Goulburn St, Sydney 2000NSW -&nbsp;&nbsp;(088) 1990 6886</div>
                        <div class="coppyright">Copyright © 2016 Bonfire</div>
                    </div>
                    <!-- end contact -->
                    <!-- social -->
                    <div class="social">
                        <a href="#" class="item"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="item"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="item"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="item"><i class="fab fa-skype"></i></a>
                    </div>
                    <!-- end social -->
                </div>
                <!-- end footer-bottom -->
            </div>
        </footer>
        <!-- End Footer -->
    </div>
   
    <script>
        $(document).ready(function () {
            $('.header .slick').slick({
                arrows: false
            });
            $('.product-image-slider .slick').slick({
                responsive: [
                    {
                        breakpoint: 576,
                        settings: {
                            arrows: false,
                        }
                    }
                ]
            });
        });
        function AddCart(id) {
            $.ajax({
                url: 'Add-Cart/' + id,
                type: 'GET',
            }).done(function (response) {
                RenderCart(response);
                alertify.success('Product has been added to Cart');

            });
        }
        $("#change-item-cart").on("click", ".del-cart", function () {
            $.ajax({
                url: 'Delete-Item-Cart/' + $(this).data("id"),
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
</body>

</html>