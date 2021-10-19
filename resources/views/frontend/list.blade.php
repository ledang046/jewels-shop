@extends("frontend.layout")
@section("do-du-lieu")
<link rel="stylesheet" type="text/css" href="{{ asset('css/list-cart-style.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div style="margin-top:25px;" class="wrap cf">
@if(session()->has('successMsg'))
  <div class="alert alert-success" role="alert">
      <button type="button" class="close" id="alert" data-dismiss="alert">x</button> 
      {{session()->get('successMsg')}}
  </div>
@endif
@if(session()->has('errorMsg'))
  <div class="alert alert-danger" role="alert">
      <button type="button" class="close" id="alert" data-dismiss="alert">x</button> 
      {{session()->get('errorMsg')}}
  </div>
@endif
    <div class="heading cf">
        @if(Session::has("Cart") != null)
        <h1>My Cart</h1>
        @else
        <h1>Cart Empty</h1><br>
        @endif
        <a href="{{route('home')}}" class="continue">Continue Shopping</a>
    </div>
    <div id="cart-list">
        <div class="cart">
            <ul class="tableHead">
                <li style="padding-right:220px" class="prodHeader">Product</li>
                <li>Total</li>
                <li>Remove</li>
            </ul>
            <ul class="cartWrap">
            @if(Session::has("Cart") != null)
                @foreach(Session::get('Cart')->products as $item)
                <li class="items odd">
                                <div class="infoWrap">
                                    <div class="cartSection">
                                        <img src="images/{{$item['productInfo']->photo}}" alt="" class="itemImg" />
                                        <p class="itemNumber">#{{$item['productInfo']->id}}</p>
                                        <h3>{{$item['productInfo']->name}}</h3>

                                        <p><input data-id="{{$item['productInfo']->id}}" class="qty" type="number" id="quanty-item-{{$item['productInfo']->id}}" placeholder="{{$item['quanty']}}" value="{{$item['quanty']}}" /> 
                                        x ${{$item['productInfo']->price - $item['productInfo']->price*$item['productInfo']->discount /100}}</p>

                                        <p style="cursor:pointer;" class="stockStatus" onclick="SaveListItemCart({{$item['productInfo']->id}});" id="ti-save" >Update</p>
                                    </div>


                                    <div class="prodTotal cartSection">
                                        <p>{{$item['price']}}$</p>
                                    </div>
                                    <div class="cartSection removeWrap">
                                        <a href="#" href="javascript:" onclick="DeleteListItemCart({{$item['productInfo']->id}});" class="remove">x</a>
                                    </div>
                                </div>
                </li>
                @endforeach
            @endif
            </ul>
        </div>
        @if(Session::has("Cart") != null)
        <div id="promoCode" class="promoCode"><label for="promo">Have A Promo Code?</label>
        <form method="POST" action="{{route('check.coupon')}}">
            @csrf
        <input type="text" name="coupon" value="{{isset($coupon->code) ? $coupon->code : '' }}"
                />
        <button type="submit" class="btn"></button>
        </form>
        </div>
        @else
        @endif

        <div class="subtotal cf">
            <button class="btn-update-cart">Update Cart</button>
            <ul>
                <li class="totalRow"><span class="label">Total product</span><span class="value">
                    @if(Session::has("Cart") != null)
                    {{Session::get("Cart")->totalQuanty}}
                    @else 0
                    @endif
                </span>
                </li>
                <li class="totalRow final"><span class="label">Total</span><span class="value">
                    @if(Session::has("Cart") != null)
                    {{number_format(Session::get('Cart')->totalPrice)}}$
                    @else 0
                    @endif
                
                </span>
                </li>
                <li class="totalRow">
                <span class="label">Coupon</span>
                    <span class="value">
                    @if(Session::get('coupon'))
                        @foreach(Session::get('coupon') as $key => $cou)
                        
                            @if($cou['condition'] == 1)
                                Discount: {{$cou['number']}}%
                                    @php
                                    $total_coupon = (Session::get('Cart')->totalPrice * $cou['number'])/100;
                                    Session::get('Cart')->totalPrice = Session::get('Cart')->totalPrice - $total_coupon;
                                    echo '<li class="totalRow"><span class="label">Total discount:</span><span class="value">' . $total_coupon . '$</span></li>';
                                    
         
                                    @endphp
                                <li class="totalRow final"><span class="label">Total</span><span class="value">{{number_format(Session::get('Cart')->totalPrice)}}$</span></li>
                            @elseif($cou['condition'] == 2)
                                     {{$cou['number']}}$ Off
                                        @php
                                        $total_coupon = (Session::get('Cart')->totalPrice -  $cou['number']);
                                        Session::get('Cart')->totalPrice = $total_coupon;
                                        echo '<li class="totalRow final"><span class="label">Total discount:</span><span class="value">' . $total_coupon . '$</span></li>';
                                        
                                       
                                        @endphp
                            
                            @endif
                        @endforeach

                    @endif
                    
                </span></li>
                
                @if(Session::has("Cart") != null)
                <li class="totalRow"><a href="{{route('checkout')}}" class="btn continue">Checkout</a></li>
                @else 
                @endif
            </ul>
        </div>
    </div>
</div>
<script>
    // Just for testing, show all items
    $('a.btn.continue').click(function () {
        $('li.items').show(400);
    })
    // Delete Item from Cart
    function DeleteListItemCart(id){
            $.ajax({
                url: 'Delete-Item-List-Cart/'+id,
                type: 'GET',
            }).done(function(response) {
                RenderListCart(response);
                alertify.error('Product Deleted');
            });
        }

        function SaveListItemCart(id){
            $.ajax({
                url: 'Save-Item-List-Cart/'+id+'/'+$("#quanty-item-"+id).val(),
                type: 'GET',
            }).done(function(response) {
                RenderListCart(response);
                alertify.success('Đã cập nhật sản phẩm');
            });
        }
        function RenderListCart(response){
            $("#cart-list").empty();
            $("#cart-list").html(response);
        }
        $('.btn-update-cart').on('click',function(){
            var list = [];
            $("ul li p").each(function(){
                $(this).find("input").each(function(){
                    var element = { key: $(this).data("id"), value: $(this).val() };
                    list.push(element)
                });
            });
            $.ajax({
                url: 'Save-All',
                type: 'POST',
                data: {
                    "_token" : "{{ csrf_token() }}",
                    "data" : list,
                }
            }).done(function(response) {
                location.reload();
            });
        });
        $("document").ready(function(){
        setTimeout(function()
        {
            $("div.alert").remove();
        },3000);
     });
</script>
@endsection