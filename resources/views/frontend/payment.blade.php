@extends("frontend.layout")
@section("do-du-lieu")
<!-- Css -->
<link rel="stylesheet" href="{{asset('css/payment-style.css')}}">
<!-- Boostrap cdn -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- End Boostrap cdn -->
<div class="card">
@if(session()->has('successMsg'))
  <div class="alert alert-success" role="alert">
      <button type="button" class="close" id="alert" data-dismiss="alert">x</button> 
      {{session()->get('successMsg')}}
  </div>
@endif
    <div class="card-top border-bottom text-center"><a href="{{route('home')}}">Back to shop</a></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <div class="left border">
                    <div class="row"><span class="header">Payment</span>
                        <div class="icons"> <img src="https://img.icons8.com/color/48/000000/visa.png" /> <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /> <img src="https://img.icons8.com/color/48/000000/maestro.png" /> </div>
                    </div>
                    <form method="POST" action="{{route('payment')}}">                 
                    @csrf
                        <span>Your's name:</span> <input type="text" name="name" require> 
                        <span>Address:</span> <input type="text" name="address" require>
                        <span>Phone number:</span> <input type="text" name="phonenumber" require>
                        <span>Email</span> <input type="text" name="email" require>
                        <div class="row">
                        </div> <input type="checkbox" id="save_card" class="align-left"> <label for="save_card">Save card details to wallet</label>
                    
                </div>
            </div>
            <div class="col-md-5">
                <div class="right border">
                    <div class="header"><h4>Order Summary</h4></div>
                    @if(Session::has("Cart") != null)
                                <span>Total product: {{Session::get("Cart")->totalQuanty}}</span>
                            @else
                                <span>Total product: 0</span>
                            @endif
                    @if(Session::has("Cart") != null)
                    @foreach(Session::get('Cart')->products as $item)
                    <div class="row item">
                        <div class="col-4 align-self-center"><img class="img-fluid" src="images/{{$item['productInfo']->photo}}"></div>
                        <div class="col-8">
                            <div class="row"><b>Total:{{$item['price']}}$</b></div>
                            <div class="row text-muted">B{{$item['productInfo']->name}}</div>
                            <div class="row">${{$item['productInfo']->price - $item['productInfo']->price*$item['productInfo']->discount /100}} x Quanty:{{$item['quanty']}}</div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <hr>
                    <div class="row lower">
                        <div class="col text-left">Subtotal</div>
                        <div class="col text-right">
                        @if(Session::has("Cart") != null)
                        {{number_format(Session::get('Cart')->totalPrice)}}$
                        @else 0
                        @endif</div>
                    </div>
                    <div class="row lower">
                        <div class="col text-left">Delivery</div>
                        <div class="col text-right">Free</div>
                    </div>
                    <div class="row lower">
                        <div class="col text-left"><b>Total to pay</b></div>
                        <div class="col text-right"><b>
                        @if(Session::has("Cart") != null)
                        {{number_format(Session::get('Cart')->totalPrice)}}$
                        @else 0
                        @endif</b>
                    </div>
                    </div>
                    <div class="row lower">
                        <div class="col text-left"><a href="#"><u>Add promo code</u></a></div>
                    </div>
                    @if(Session::has("Cart") != null)
                    <button type="submit" class="btn">Continue to Payment</button>
                    @else
                    @endif
                    </form>
                    <p class="text-muted text-center">Complimentary Shipping & Returns</p>
                </div>
            </div>
        </div>
    </div>
    <div> </div>
</div>
<script>
    $("document").ready(function(){
        setTimeout(function()
        {
            $("div.alert").remove();
        },3000);
    });
</script>
@endsection