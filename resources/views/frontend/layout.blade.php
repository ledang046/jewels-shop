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
		@include('frontend.header')
		<!-- End Header -->
        <div class="page-main">
		<!-- Main Content -->
             @yield('do-du-lieu')
        </div>
		<!-- End Main Content -->
		<!-- Footer -->
		<footer class="footer">
            <div class="container">
                <!-- footer top -->
                <div class="footer-top">
                    <!-- logo -->
                    <div class="logo">
                        <img src="{{asset('images/logo-2.png')}}" alt="footer-logo">
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
        $(document).ready(function(){
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
    </script>
</body>
</html>
